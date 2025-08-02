# Changelog

All notable changes to `filament-lost-connection` will be documented in this file.

## [Unreleased]

## [1.0.0] - 2025-01-31

### Added
- Initial release
- Network connection detection and indicator
- Support for Laravel 10+ and 11+
- Support for Filament v2 and v3
- Configurable position (top/bottom)
- Customizable text messages
- Customizable colors
- Multiple icon options
- Auto-injection capability
- Manual Blade directive support
- Background overlay when disconnected
- Auto-hide connected indicator
- Full documentation

### Features
- Real-time connection monitoring
- Responsive design
- Lightweight implementation
- Security best practices
- Clean code architecture
- Extensive customization options

### Configuration Options
- `position()` - Set indicator position
- `lostConnectionText()` - Custom disconnect message
- `connectedText()` - Custom reconnect message
- `lostConnectionColor()` - Disconnect indicator color
- `connectedColor()` - Reconnect indicator color
- `icon()` - Custom icon selection
- `enabled()` - Enable/disable plugin
- `checkInterval()` - Connection check frequency
- `testUrl()` - Custom ping endpoint

### Technical Details
- PHP 8.1+ support
- Modern JavaScript implementation
- Tailwind CSS integration
- Service Provider architecture
- Facade support
- PSR-4 autoloading
- PHPUnit test coverage
