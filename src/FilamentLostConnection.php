<?php

namespace Amarafiif\FilamentLostConnection;

use Filament\Contracts\Plugin;
use Filament\Panel;
use Filament\Support\Facades\FilamentView;
use Filament\View\PanelsRenderHook;
use Illuminate\Support\Facades\View;

class FilamentLostConnection implements Plugin
{
    protected string $position = 'bottom';

    protected string $lostConnectionText = 'You are disconnected.';

    protected string $connectedText = 'You are back online.';

    protected string $icon = 'heroicon-o-exclamation-triangle';

    protected string $lostConnectionColor = '#e11d48';

    protected string $connectedColor = '#059669';

    protected int $checkInterval = 3000;

    protected ?string $pingUrl = null;

    public static function make(): static
    {
        return new static;
    }

    public function getId(): string
    {
        return 'filament-lost-connection';
    }

    public function register(Panel $panel): void
    {
        //
    }

    public function boot(Panel $panel): void
    {
        $this->loadConfigurationDefaults();

        FilamentView::registerRenderHook(
            PanelsRenderHook::BODY_START,
            function (): string {
                try {
                    return View::make('filament-lost-connection::lost-connection-indicator', [
                        'position' => $this->position,
                        'lostConnectionText' => $this->lostConnectionText,
                        'connectedText' => $this->connectedText,
                        'icon' => $this->icon,
                        'lostConnectionColor' => $this->lostConnectionColor,
                        'connectedColor' => $this->connectedColor,
                        'checkInterval' => $this->checkInterval,
                        'pingUrl' => $this->pingUrl ?? 'https://httpbin.org/status/200',
                    ])->render();
                } catch (\Exception $e) {
                    return '';
                }
            }
        );
    }

    protected function loadConfigurationDefaults(): void
    {
        if (class_exists('\Illuminate\Support\Facades\App')) {
            try {
                $app = \Illuminate\Support\Facades\App::getInstance();
                if ($app && $app->bound('config')) {
                    $config = $app->make('config');

                    if ($config->has('filament-lost-connection')) {
                        $this->position = $config->get('filament-lost-connection.position', $this->position);
                        $this->lostConnectionText = $config->get('filament-lost-connection.messages.lost_connection', $this->lostConnectionText);
                        $this->connectedText = $config->get('filament-lost-connection.messages.connected', $this->connectedText);
                        $this->lostConnectionColor = $config->get('filament-lost-connection.colors.lost_connection', $this->lostConnectionColor);
                        $this->connectedColor = $config->get('filament-lost-connection.colors.connected', $this->connectedColor);
                        $this->checkInterval = $config->get('filament-lost-connection.check_interval', $this->checkInterval);
                        $this->icon = $config->get('filament-lost-connection.icon', $this->icon);
                        $this->pingUrl = $config->get('filament-lost-connection.ping_url', $this->pingUrl);
                    }
                }
            } catch (\Exception $e) {
                //
            }
        }
    }

    public function position(string $position): static
    {
        $this->position = $position;

        return $this;
    }

    public function lostConnectionText(string $text): static
    {
        $this->lostConnectionText = $text;

        return $this;
    }

    public function connectedText(string $text): static
    {
        $this->connectedText = $text;

        return $this;
    }

    public function icon(string $icon): static
    {
        $this->icon = $icon;

        return $this;
    }

    public function lostConnectionColor(string $color): static
    {
        $this->lostConnectionColor = $color;

        return $this;
    }

    public function connectedColor(string $color): static
    {
        $this->connectedColor = $color;

        return $this;
    }

    public function checkInterval(int $ms): static
    {
        $this->checkInterval = $ms;

        return $this;
    }

    public function pingUrl(string $url): static
    {
        $this->pingUrl = $url;

        return $this;
    }
}
