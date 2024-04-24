<?php

namespace AutomatedEmails\Original\Creators\Model\Domain;

use AutomatedEmails\Original\Creators\ModelTemplateProjectFileCreator;
use AutomatedEmails\Original\Language\Classes\Properties;
use AutomatedEmails\Original\Language\Classes\Property;
use AutomatedEmails\Original\Renderers\Abilities\Renderable;
use AutomatedEmails\Original\Renderers\Classes\VisibilityRenderer;
use AutomatedEmails\Original\Renderers\Factories\PropertyMethodsRendererFactory;
use AutomatedEmails\Original\Renderers\Language\ImportRenderer;
use AutomatedEmails\Original\Renderers\Language\InlineStatementsRenderer;
use AutomatedEmails\Original\Renderers\Language\NativeTypedVariableRenderer;
use AutomatedEmails\Original\Renderers\Language\NewLineRenderer;
use AutomatedEmails\Original\Renderers\Language\TabRenderer;
use AutomatedEmails\Original\Renderers\Language\VariableRenderer;
use AutomatedEmails\Original\Renderers\RendererComposite;

Class EntityFileCreator extends ModelTemplateProjectFileCreator
{
    private $properties;

    public function setProperties(Properties $properties)
    {
        $this->properties = $properties; 
    }
    
    protected function getModelTypeName() : string
    {
        return 'entity';
    }

    protected function getTemplatePath() : string
    {
        return dirname(__FILE__).'/EntityTemplate.php';
    }

    protected function getVariablestoPassToTemplate() : array
    {
        return array_merge(parent::getVariablestoPassToTemplate(), [
            'propertyImportsRenderer' => $this->getPropertyImportsRenderer(),
            'propertiesRenderer' => $this->getPropertiesRenderer(),
            'propertyMethodsRenderer' => $this->getPropertyMethodsRenderer(),
            'testGroup' => 'entity'
        ]);
    }

    protected function getPropertyImportsRenderer() : Renderable
    {
        (object) $propertyImportsRenderer = new NewLineRenderer(
            new InlineStatementsRenderer($this->properties->getAllClassTypedNoDuplicates()->map(function(Property $property) : Renderable {
                    return new ImportRenderer($property->getShortType());
                })
            )
        );

        $propertyImportsRenderer->setLineDirection('top');

        return $propertyImportsRenderer;
    }
    
    protected function getPropertiesRenderer() : Renderable
    {
        return new InlineStatementsRenderer($this->properties->asCollection()->map(function(Property $property) : Renderable {
            (object) $nativeTypedVariableRenderer = new NativeTypedVariableRenderer(new VariableRenderer($property->getName()));
            (object) $privateVisibilityRenderer = new VisibilityRenderer($nativeTypedVariableRenderer);

            $nativeTypedVariableRenderer->setType($property->getLongType());
            $privateVisibilityRenderer->setVisibility('private');

            return new TabRenderer($privateVisibilityRenderer);
        }));   
    }
 
    protected function getPropertyMethodsRenderer() : Renderable
    {
        return new RendererComposite($this->properties->asCollection()->map(function(Property $property) : Renderable {
            (object) $propertyMethodsRendererFactory = new PropertyMethodsRendererFactory($property);

            return new RendererComposite($propertyMethodsRendererFactory->getAll());
        }));   
    }
}