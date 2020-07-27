# EWP Contact

Drupal implementation of the EWP Academic Term Type.

See the **Erasmus Without Paper** specification for more information:

  - [EWP Academic Term Data Types](https://github.com/erasmus-without-paper/ewp-specs-types-academic-term)

## Installation

Include the repository in your project's `composer.json` file:

    "repositories": [
        ...
        {
            "type": "vcs",
            "url": "https://github.com/EuropeanUniversityFoundation/ewp_academic_term"
        }
    ],

Then you can require the package as usual:

    composer require euf/ewp_academic_term

Finally, install the module:

    drush en ewp_academic_term

## Usage

A custom content entity named **Academic Term** is provided with initial configuration to match the EWP specification. It can be configured like any other fieldable entity on the system. The administration paths are placed under `/admin/ewp/`.
