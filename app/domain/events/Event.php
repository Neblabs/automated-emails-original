<?php

namespace AutomatedEmails\App\Domain\Events;

use AutomatedEmails\App\Components\Abilities\Identifiable;
use AutomatedEmails\App\Components\Abilities\IdentifiableComponent;
use AutomatedEmails\App\Creation\Entities\Conditionroots\ConditionsRootFromTemplateFactory;
use AutomatedEmails\App\Domain\ConditionRoots\ConditionsRoot;
use AutomatedEmails\App\Domain\Data\Abilities\Datasetcolectiongetters\DataSetCollectionFromEvent;
use AutomatedEmails\App\Domain\Data\Abilities\DataSetCollection;
use AutomatedEmails\App\Domain\Data\DataCollection;
use AutomatedEmails\App\Domain\Data\DataType;
use AutomatedEmails\App\Domain\Events\Supporteddata\EventDataSet;
use AutomatedEmails\Original\Characters\StringManager;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Construction\Events\EventHandlerFactory;
use AutomatedEmails\Original\Construction\Events\HookFactory;
use AutomatedEmails\Original\Domain\Entity;
use AutomatedEmails\Original\Events\Parts\DefaultPriority;
use AutomatedEmails\Original\Events\Subscriber;
use AutomatedEmails\Original\Events\SubscriberRequiresEventHandler;
use AutomatedEmails\Original\Events\Wordpress\Abilities\CustomEvent;
use AutomatedEmails\Original\Events\Wordpress\EventHandler;
use AutomatedEmails\Original\Events\Wordpress\EventsHandler;
use AutomatedEmails\Original\Events\Wordpress\Request;
use AutomatedEmails\Original\Events\Wordpress\SubscribersNotifier;
use AutomatedEmails\Original\System\Functions\GlobalFunctionWrapper;
use AutomatedEmails\Original\Validation\Validators\CollectionHasKey;
use InvalidArgumentException;
use ReflectionClass;
use Stringable;

use function AutomatedEmails\Original\Utilities\Collection\_;
use function AutomatedEmails\Original\Utilities\Text\i;
use function AutomatedEmails\Original\Utilities\validate;

Abstract Class Event extends Entity implements 
    CustomEvent, 
    Subscriber, 
    SubscriberRequiresEventHandler,
    DataSetCollection,
    IdentifiableComponent,
    Stringable
{
    use DefaultPriority;
    
    /**
     * Hook to subscribe to.
     */
    abstract protected function hook() : Request\Hook;

    protected EventHandler $eventHandler;
    protected ConditionsRootFromTemplateFactory $conditionsRootFromTemplateFactory;
    /**
     * The generated DataCollection s for the supported Data Types
     * 
     * DataTypeId => DataCollection
     * eg:
     * 'post' => PostsData
     */
    protected Collection $dataSets;
    protected Identifiable $component;

    public function __construct(
        //protected SubjectConditionFromMappedTemplateFactory $subjectConditionsFactory,
        protected HookFactory $hookFactory = new HookFactory,
        protected SubscribersNotifier $subscribersNotifier = new SubscribersNotifier(
            globalFunctionWrapper: new GlobalFunctionWrapper, 
            eventsHandler: new EventsHandler(new EventHandlerFactory)
        ),
    ) {
        $this->dataSets = new Collection([]);
    }

    public function setEventHandler(EventHandler $eventHandler)
    {
        $this->eventHandler = $eventHandler;
    } 

    public function setConditionsRootFromTemplateFactory(ConditionsRootFromTemplateFactory $conditionsRootFromTemplateFactory) : void
    {
        $this->conditionsRootFromTemplateFactory = $conditionsRootFromTemplateFactory;
    }

    public function addSubscriber(Subscriber $subscriber) : void
    {
        $this->subscribersNotifier->addSubscriber($subscriber);
    }

    /**
     * Register the current instance as a Subscriber for a native WordPress hook.
     */
    public function register() : void
    {
        (object) $hook = $this->hookFactory->createFromRequest($this->hook());

        $hook->add(subscriber: $this);

        $hook->register();
    }

    public function execute() : void
    {
        /**
         * Gets executed when the native WordPress hook has been triggered
         *
         * At this point, the validation method of the extending class has been 
         * executed (by an EventHandler) and it has passed.
         * 
         */

        $this->setEventData();

        /**
         * A "clean" event will be triggered
         * when the dirty native WordPress hook is being triggered
         */        
        $this->subscribersNotifier->notify($this);
    }

    /**
     * Gets the DataSet for a specific DataType
     *
     * eg: static::dataSet('post') --> PostsDataSet 
     */
    public function dataSet(string $dataTypeId) : DataCollection
    {
        validate(
            (new CollectionHasKey($this->dataSets, key: $dataTypeId))->withException(
                new InvalidArgumentException("Unexistent data set: {$dataTypeId}")
            )
        );

        return $this->dataSets->get($dataTypeId);
    }

    protected function setEventData() : void
    {
        foreach ($this->getDataSetInterfaces() as $dataSetInterface) {
            $this->setDataSetFromInterface($dataSetInterface);
        }
    }

    /**
     * @return Collection<ReflecionClass>
     */
    protected function getDataSetInterfaces() : Collection
    {
        // get the dataset interfaces
        (object) $reflectionClass = new ReflectionClass($this);

        (object) $onlyEventDataSets = fn(ReflectionClass $interface) => $interface->implementsInterface(EventDataSet::class);
        (object) $notEventDataSetBaseInterface = fn(ReflectionClass $interface) => $interface->getName() !== EventDataSet::class;

        return _($reflectionClass->getInterfaces())->filter($onlyEventDataSets) 
                                                   ->filter($notEventDataSetBaseInterface);
    }
 
    protected function setDataSetFromInterface(ReflectionClass $dataSetInterface) : void
    {
        (object) $interfaceName = i($dataSetInterface->getShortName());

        (string) $dataSetSetupMethodName = $interfaceName->toLowerCase();
        (string) $dataSetPropertyName = $dataSetSetupMethodName;

        (object) $dataSet = $this->{$dataSetSetupMethodName->get()}(...$this->eventHandler->requestedArgumentsFor($dataSetSetupMethodName->get()));
        (object) $dataType = $this->{"{$dataSetSetupMethodName->get()}DataType"}();

        $this->setDataSet(dataType: $dataType, dataCollection: $dataSet);
    }

    protected function setDataSet(DataType $dataType, DataCollection $dataCollection) : void
    {
        $this->dataSets->set(key: $dataType->id(), value: $dataCollection);   
    }

    public function defaultConditions(): ConditionsRoot
    {
        $this->conditionsRootFromTemplateFactory->setDataSetCollectionGetter(
            new DataSetCollectionFromEvent($this)
        );

        return $this->conditionsRootFromTemplateFactory->createEntity(
            $this->defaultConditionsTemplate()
        );
    } 

    # Should be extended if needed, by default no default conditions are returned
    protected function defaultConditionsTemplate() : StringManager
    {
        return _(
            type: 'none',
            subjectConditions: []
        )->asJson();
    }
    
    /**
     * This is used in contexts like in WordPressPostQueryParameters::setMetaValue()
     */
    public function __toString(): string
    {
        return $this->component()->identifier();
    } 
}