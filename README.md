# ImpactViz Plugin for OJS

ImpactViz - Open Impact Vizualiser enables the display of open metrics on article pages

Open scientometric indicators enable a comprehensible evaluation of science. The tool "ImpactViz - Open Impact Vizualizer" ([Github](https://github.com/tibhannover/rosi-prototype)), developed in the project [ROSI (Reference Implementation for Open Scientometric Indicators)](https://tib.eu/rosi-project), enables the adaptable presentation of open scientometric information from scientific publications.

As a plugin for [Open Journal Systems (OJS)](https://pkp.sfu.ca/ojs/), ImpactViz enables the article page to be supplemented by the presentation of scientometric indicators of the respective article. The presentation is divided into four concepts: "Scientific Impact", "Societal Impact", "Community Impact" and "Openness". In an additional detailed view, the indicators grouped by concept can be viewed in more detail. Journal editors can change the selection of indicators and add new ones.

## Features

The plugin will:
* add small overview icons to article page (right column below other metadata),
* display bigger overview icons and detailed views on click in article details (left column below abstract) and
* add a new page to the about section, where the user will find some information about the displayed informations (tba).

## License

This plugin is licensed under the GNU General Public License v3. See the file LICENSE for the complete terms of this license.

## System Requirements

This plugin is compatible with OJS 3.1 version and OMP 3.1 version.

## Installation

Clone this repo in your plugin folder (/plugins/generic) or download the code and tar.gz it and upload it via the gui (Website Settings > Plugins).

## Settings

The following settings are available:
- select the indicators that will be displayed
- add a new indicator
- determine the position of the icons on your web site (overview, sidebar or article/book page)
- choose the orientation of the social media buttons (vertical or horizontal)

## Usage
Install the plugin as described above, activate it and choose the settings you prefer.

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
