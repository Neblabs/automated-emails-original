<?php

namespace AutomatedEmails\App\Subscribers;

use AutomatedEmails\App\Dashboard\DashboardData;
use AutomatedEmails\App\Domain\Posts\Post;
use AutomatedEmails\App\Presentation\Components\Dashboarddevelopmentscripts\DashboardDevelopmentScripts;
use AutomatedEmails\Original\Collections\Collection;
use AutomatedEmails\Original\Environment\Env;
use AutomatedEmails\Original\Events\Parts\DefaultPriority;
use AutomatedEmails\Original\Events\Subscriber;
use AutomatedEmails\Original\Events\Wordpress\EventArguments;
use AutomatedEmails\Original\Files\InlineReadableFile;
use AutomatedEmails\Original\Files\NativeFileReader;
use AutomatedEmails\Original\Validation\Validator;
use AutomatedEmails\Original\Validation\Validators\PassingValidator;

use function AutomatedEmails\Original\Utilities\Collection\_;

Class DashboardScriptsRegistrator implements Subscriber
{
    use DefaultPriority;

    public function __construct(
        protected DashboardData $dashboardData
    ) {}
    
    public function createEventArguments(string $hook) : EventArguments
    {
        return new EventArguments(_(
            hook: $hook
        ));
    }

    public function validator() : Validator
    {
        return new PassingValidator;
    }

    public function execute(string $hook)
    {
        $this->registerGlobalStylesAndScripts();

        if (!in_array($hook, ['post.php', 'post-new.php']) || !(($screen = get_current_screen()) && $screen->post_type === 'automatedemail')) {
            return;
        }

        wp_enqueue_style(
            Env::getwithPrefix('dashboard-styles'), 
            Env::directoryURI().'/app/scripts/dashboard/styles/build/dashboard.css',
            null,
            $version = Env::settings()->environment === 'development'? time() : '1.2.0'
        );

        (boolean) $loadProduction = Env::settings()->environment === 'production';

        (string) $dashboardID = Env::getwithPrefix('dashboard');

        if ($loadProduction) {
            (object) $assetsData = static::getAssetsData();

            wp_enqueue_script(
                $id = $dashboardID, 
                $source = Env::directoryURI()."app/scripts/dashboard/build{$assetsData->get('files')->{'main.js'}}", 
                $dependencies = array_filter([
                    'jquery', 
                    function_exists('wp_set_script_translations') ? 'wp-i18n' : ''
                ]), 
                $version = Env::settings()->environment === 'development'? time() : '1.2.0',
                $inFooter = true
            );

            wp_add_inline_script(
                handle: $dashboardID, 
                data: 'window.lodash = _.noConflict();', 
                position: 'after'
            );

            if (function_exists('wp_set_script_translations')) {
                wp_set_script_translations(
                    $id, 
                    Env::settings()->app->textDomain,
                    Env::directory().'international/'
                );
            };
        } else {
            // ONLY USED FOR THE DEVELOPMENT SCRIPTS, 
            // THIS IS IGNORED ON LIVE SITES
            if (Env::settings()->environment === 'development') {
                (object) $dashboardDevelopmentScripts = new DashboardDevelopmentScripts($dashboardID);

                $dashboardDevelopmentScripts->render();
            }
        }

        (object) $dashboardData = $this->dashboardData;

        wp_localize_script(
            $dashboardID, 
            $dashboardData->key(), 
            $dashboardData->export(new Post(post: $GLOBALS['post']))
        );

        wp_enqueue_style( 
            Env::getwithPrefix('dashboard-font'), 
            'https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600&display=swap',
            null,
            $version = Env::settings()->environment === 'development'? time() : '1.2.0'
        );
    }

    protected function registerGlobalStylesAndScripts()
    {
        wp_enqueue_style(
            Env::getwithPrefix('global'), 
            Env::directoryURI().'app/styles/dashboard-global.css',
            null,
            $version = Env::settings()->environment === 'development'? time() : '1.2.0'
        );
    }

    public static function getAssetsData() : Collection
    {
        (object) $fileReader = new NativeFileReader;

        return new Collection((array) json_decode(
            $fileReader->read(new InlineReadableFile(
                Env::getAppDirectory('dashboard').'build/asset-manifest.json'
            ))
        ));;
    }
} 

