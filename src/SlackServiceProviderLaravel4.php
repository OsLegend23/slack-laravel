<?php

namespace OsLegend23\Slack;

use Illuminate\Support\ServiceProvider;
use Maknz\Slack\Client as Client;
use GuzzleHttp\Client as Guzzle;

class SlackServiceProviderLaravel4 extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('oslegend23/slack-laravel', null, __DIR__);
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('maknz.slack', function ($app) {
            $allow_markdown = $app['config']->get('slack::allow_markdown');

            $markdown_in_attachments = $app['config']->get('slack::markdown_in_attachments');

            $unfurl_media = $app['config']->get('slack::unfurl_media');

            return new Client(
                $app['config']->get('slack::endpoint'),
                [
                    'channel' => $app['config']->get('slack::channel'),
                    'username' => $app['config']->get('slack::username'),
                    'icon' => $app['config']->get('slack::icon'),
                    'link_names' => $app['config']->get('slack::link_names'),
                    'unfurl_links' => $app['config']->get('slack::unfurl_links'),
                    'unfurl_media' => is_bool($unfurl_media) ? $unfurl_media : true,
                    'allow_markdown' => is_bool($allow_markdown) ? $allow_markdown : true,
                    'markdown_in_attachments' => is_array($markdown_in_attachments) ? $markdown_in_attachments : [],
                ],
                new Guzzle
            );
        });

        $this->app->bind('Maknz\Slack\Client', 'maknz.slack');
    }
}
