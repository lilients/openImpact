# Open Impact Vizualizer Plugin

This plugin adds impact information to to the article page. It implements ImpactViz ([Github](https://github.com/tibhannover/rosi-prototype) in [Open Journal Systems](https://pkp.sfu.ca/ojs/).

## Features

Available indicators are: tba

New indicators can be added.

The selection of indicators that will be displayed can be customized.

## License

This plugin is licensed under the GNU General Public License v2. See the file LICENSE for the complete terms of this license.

## System Requirements

This plugin is compatible with OJS 3.x version and OMP 3.x version.

## Installation

Clone this repo in your plugin folder (/plugins/generic) or download the code and tar.gz it and upload it via the gui (Website Settings > Plugins).

## Settings

The following settings are available:
- select the indicators that will be displayed
- add a new indicator
- determine the position of the icons on your web site (overview, sidebar or article/book page)
- choose the orientation of the social media buttins (vertical or horizontal)

## Usage
Install the plugin as described above, activate it and choose the settings you prefer. If you choose the sidebar option, you need to enable the new block under management/settings/website.

## Contact/Support

Contact us via rosi.project@tib.eu. Find out more about the project [ROSI](https://tib.eu/rosi-project).

## Version History

* 1.0 - Open Impact Plugin for OJS 3

## Technical Documentation

This plugin works for OJS 3 and OMP 3 (the code is the same). The [ImpactViz Code](https://github.com/tibhannover/rosi-prototype) is included in the plugin code (MIT License). It adds the impact icons using html, css and js. The plugin uses hooks to add content, no existing templates are being overwritten. No database access is needed.

### Hooks

The buttons are added via template hooks:
* Templates::Article::Details
* Templates::Catalog::Book::Details
