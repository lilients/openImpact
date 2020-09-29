# ImpactViz Plugin for OJS

ImpactViz - Open Impact Vizualiser enables the display of open metrics on article pages

Open scientometric indicators enable a comprehensible evaluation of science. The tool "ImpactViz - Open Impact Vizualizer" ([Github](https://github.com/tibhannover/rosi-prototype)), developed in the project [ROSI (Reference Implementation for Open Scientometric Indicators)](https://tib.eu/rosi-project), enables the adaptable presentation of open scientometric information from scientific publications.

As a plugin for [Open Journal Systems (OJS)](https://pkp.sfu.ca/ojs/), ImpactViz enables the article page to be supplemented by the presentation of scientometric indicators of the respective article. The presentation is divided into four concepts: "Scientific Impact", "Societal Impact", "Community Impact" and "Openness". In an additional detailed view, the indicators grouped by concept can be viewed in more detail. Journal editors can change the selection of indicators and add new ones.

## Features

 <a href="https://blogs.tib.eu/wp/tib/wp-content/uploads/sites/3/2020/09/impactViz_at_articlepage_small.png"><img src="https://blogs.tib.eu/wp/tib/wp-content/uploads/sites/3/2020/09/impactViz_at_articlepage_small.png" align="right" width="350"></a>
  <a href="https://blogs.tib.eu/wp/tib/wp-content/uploads/sites/3/2020/09/impactViz_openness.png"><img src="https://blogs.tib.eu/wp/tib/wp-content/uploads/sites/3/2020/09/impactViz_openness.png" align="right" width="250"></a>

The plugin will:
* display the impact of the respective article in an overview below the abstract of an article,
* visualize the impact of the article in four concepts (scientific impact, societal impact, community impact and openness),
* display each concept with a colored icon when there is data available for this concept - or an empty one if no data has been found,
* display detailed views for each concept,
* add a new page to the about section, where the user will find some information about the displayed informations (tba).

## License

This plugin is licensed under the GNU General Public License v3. See the file LICENSE for the complete terms of this license.

## System Requirements

This plugin is compatible with OJS 3.1 version version.

## Installation

Clone this repo in your plugin folder (/plugins/generic) or download the code and tar.gz it and upload it via the gui (Website Settings > Plugins).

## Settings

 <a href="https://blogs.tib.eu/wp/tib/wp-content/uploads/sites/3/2020/09/impactViz_plugin-settings.png"><img src="https://blogs.tib.eu/wp/tib/wp-content/uploads/sites/3/2020/09/impactViz_plugin-settings.png" align="right" width="250"></a>

The plugin settings allow the selection of the available indicators. New indicators can be added directly in the respective JSON file.

## Usage
Install the plugin as described above, activate it and choose the settings you prefer.

## Contact/Support

Contact us via rosi.project@tib.eu. Find out more about the project [ROSI](https://tib.eu/rosi-project).

## Version History

* 1.0 - Open Impact Plugin for OJS 3

## Technical Documentation

This plugin works for OJS 3. The [ImpactViz Code](https://github.com/tibhannover/rosi-prototype) is included in the plugin code (MIT License). It adds the impact icons using html, css and js. The plugin uses hooks to add content, no existing templates are being overwritten. No database access is needed.

### Hooks

The buttons are added via template hooks:
* Templates::Article::Details
* Templates::Catalog::Book::Details
