# Filament Lost Connection

A beautiful and customizable network connection status indicator for Laravel Filament applications. This plugin automatically detects when users lose internet connectivity and displays a non-intrusive notification.

## Features

- 🌐 Real-time connection monitoring
- 🎨 Fully customizable appearance and messages
- 📱 Responsive design with smooth animations
- ⚙️ Flexible configuration options
- 🔧 Custom ping URL support
- 🎯 Easy integration with Filament panels

## Installation

You can install the package via Composer:

```bash
composer require amarafiif/filament-lost-connection
```

## Configuration

### Option 1: Using Configuration File (Recommended)

Publish the configuration file:

```bash
php artisan vendor:publish --tag="filament-lost-connection-config"
```

This will create a `config/filament-lost-connection.php` file where you can customize all settings:

```php
<?php

return [
    'ping_url' => env('FILAMENT_LOST_CONNECTION_PING_URL', null),
    'check_interval' => env('FILAMENT_LOST_CONNECTION_CHECK_INTERVAL', 3000),
    'position' => env('FILAMENT_LOST_CONNECTION_POSITION', 'bottom'),
    'messages' => [
        'lost_connection' => env('FILAMENT_LOST_CONNECTION_MESSAGE', '⚠️ Kamu tidak terhubung ke internet.'),
        'connected' => env('FILAMENT_CONNECTED_MESSAGE', '🔌 Koneksi tersambung kembali.'),
    ],
    'colors' => [
        'lost_connection' => env('FILAMENT_LOST_CONNECTION_COLOR', '#991b1b'),
        'connected' => env('FILAMENT_CONNECTED_COLOR', '#065f46'),
    ],
    'icon' => env('FILAMENT_LOST_CONNECTION_ICON', 'heroicon-o-exclamation-triangle'),
];
```

### Option 2: Using Fluent API

Register the plugin in your Filament Panel Provider (e.g., `app/Providers/Filament/AdminPanelProvider.php`):

```php
<?php

namespace App\Providers\Filament;

use Amarafiif\FilamentLostConnection\FilamentLostConnection;
use Filament\Panel;
use Filament\PanelProvider;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            // ... other configurations
            ->plugins([
                FilamentLostConnection::make()
                    ->position('bottom') // 'top' or 'bottom'
                    ->lostConnectionText('⚠️ Connection lost!')
                    ->connectedText('✅ Back online!')
                    ->lostConnectionColor('#dc2626')
                    ->connectedColor('#16a34a')
                    ->checkInterval(5000) // Check every 5 seconds
                    ->pingUrl('https://your-server.example/...') // Custom ping URL
                    ->icon('heroicon-o-wifi'),
            ]);
    }
}
```

## Usage Examples

### Basic Usage

```php
FilamentLostConnection::make()
```

### Custom Messages

```php
FilamentLostConnection::make()
    ->lostConnectionText('📵 No internet connection')
    ->connectedText('🌐 Connected to internet')
```

### Custom Styling

```php
FilamentLostConnection::make()
    ->position('top')
    ->lostConnectionColor('#ef4444')
    ->connectedColor('#10b981')
    ->icon('heroicon-o-exclamation-circle')
```

### Custom Ping URL

```php
FilamentLostConnection::make()
    ->pingUrl('https://httpbin.org/status/200')
    ->checkInterval(2000) // Check every 2 seconds
```

### Environment Variables

You can also configure the plugin using environment variables in your `.env` file:

```env
FILAMENT_LOST_CONNECTION_PING_URL=https://www.google.com/favicon.ico
FILAMENT_LOST_CONNECTION_CHECK_INTERVAL=3000
FILAMENT_LOST_CONNECTION_POSITION=bottom
FILAMENT_LOST_CONNECTION_MESSAGE="⚠️ You are offline"
FILAMENT_CONNECTED_MESSAGE="🔌 You are back online"
FILAMENT_LOST_CONNECTION_COLOR="#991b1b"
FILAMENT_CONNECTED_COLOR="#065f46"
FILAMENT_LOST_CONNECTION_ICON="heroicon-o-exclamation-triangle"
```

## Configuration Options

| Option | Type | Default | Description |
|--------|------|---------|-------------|
| `position` | string | `'bottom'` | Position of indicator (`'top'` or `'bottom'`) |
| `lostConnectionText` | string | `'You are disconnected.'` | Message when connection is lost |
| `connectedText` | string | `'You are back online.'` | Message when connection is restored |
| `lostConnectionColor` | string | `'#991b1b'` | Background color when offline |
| `connectedColor` | string | `'#065f46'` | Background color when back online |
| `checkInterval` | int | `3000` | Check interval in milliseconds |
| `icon` | string | `'heroicon-o-exclamation-triangle'` | Icon component to display |
| `pingUrl` | string | `null` | Custom URL to ping (defaults to domain favicon) |

## How It Works

The plugin uses multiple methods to detect connectivity:

1. **Browser Events**: Listens to `online` and `offline` events
2. **HTTP Requests**: Periodically sends HEAD requests to check connectivity
3. **Navigator API**: Falls back to `navigator.onLine` as a backup

### Ping URL Options

- **Default**: Uses your domain's favicon (`/favicon.ico`)
- **Custom**: You can specify any URL to ping
- **Popular options**:
  - `https://www.google.com/favicon.ico`
  - `https://httpbin.org/status/200`
  - `https://1.1.1.1/favicon.ico`

## Customization

### Custom Views

You can publish and customize the views:

```bash
php artisan vendor:publish --tag="filament-lost-connection-views"
```

This will publish the views to `resources/views/vendor/filament-lost-connection/`.

### Styling

The component uses Tailwind CSS classes and can be easily customized through the color options or by modifying the published views.

## Troubleshooting

### Plugin Not Showing

1. Make sure you've registered the plugin in your Panel Provider
2. Check that the plugin is using the correct render hook: `panels::body.end`
3. Ensure your views are properly loaded by the service provider

### Connection Check Not Working

1. Verify your `pingUrl` is accessible and returns a successful response
2. Check browser console for any CORS issues
3. Try different ping URLs if the default doesn't work in your environment

## Contributing

Contributions are welcome! Please feel free to submit a Pull Request.

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Credits

- [Muhammad Ammar Afif](https://github.com/amarafiif)
- [All Contributors](../../contributors)

## Support

If you find this package helpful, please consider giving it a ⭐ on GitHub!
