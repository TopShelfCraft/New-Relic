# New Relic plugin changelog

The format of this file is based on ["Keep a Changelog"](http://keepachangelog.com/). This project adheres to [Semantic Versioning](http://semver.org/). Version numbers follow the pattern: `MAJOR.FEATURE.BUGFIX`


## 4.0.1 - 2022-05-16

### Improved

- Added icon backfield for improved readability on dark backgrounds.


## 4.0.0 - 2022-05-15

### Improved

- New Relic is ready for Craft 4!
- Control panel settings inputs now support environment variables.
- All route segments are now prefixed with `/` in transaction names. (Improves overall consistency and prevents PHP warnings on the homepage route.) ([#6](https://github.com/TopShelfCraft/New-Relic/issues/6)) 

### Changed

- Fully typed `Settings` properties.
- Moved `Settings` model to the root namespace.

### Removed

- Removed `NewRelic::$plugin` static accessor; use `getInstance()` instead.


## 3.1.0 - 2019-05-27

### Added

- Added optional setting to override Segment 2 in reported paths. (h/t Ibrahim Lawal, [#5](https://github.com/TopShelfCraft/New-Relic/issues/5))


## 3.0.3 - 2018-09-17

### Added

- Added compatibility with Console requests. ([#1](https://github.com/TopShelfCraft/New-Relic/issues/1))

### Changed

- Removed leading slash from transaction names in Live Preview and Console requests.


## 3.0.2 - 2018-06-27

### Added

- Initial release!
