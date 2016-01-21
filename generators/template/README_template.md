# Gherkin language support in Atom

This `Gherkin language in Atom` plugin offers:

  * Syntax Coloring based on [Atom Language Gherkin](https://github.com/gigapixel/atom-language-gherkin)
  * Internationalization in __NB_LANG__ languages based on [gherkin-languages.json](https://github.com/cucumber/gherkin/blob/master/gherkin-languages.json)
  * Simple Completion in __NB_LANG__ languages

The languages matching is done by looking at the very first line of each of the `.feature` files.

In order to use a specific language, set the first line of your feature file with the following pattern:  `# language: <langID>`, e.g. `# language: fr`.

When `# language: <langID>` is not specified, it defaults to English.

The source documentation is the [Cucumber documentation for spoken languages](https://github.com/cucumber/cucumber/wiki/Spoken-languages)

Syntax color works better with Atom One Dark theme.

![English / French / German / Japanese / Hebrew](https://github.com/mackoj/language-gherkin-i18n/blob/develop/preview.gif)

# Compatibility

  * Gherkin (3.2.0)

# List of supported languages

__LANG_LIST__

# Contributing

Contributions are greatly appreciated.
If you find a bug please consider creating an issue for it. To be treated fast consider adding a test case in the spec file in order to reproduce it.
Please fork this repository and open a pull request to add snippets, make grammar tweaks, etc.

# How it is made

Using a template for the grammar and another one for the autocompletion, we parse the [gherkin-languages.json](https://github.com/cucumber/gherkin/blob/master/gherkin-languages.json) file to generate the corresponding files for each language.

# ToDo

  * Add unit tests
  * Add Snippets for table and most used keyword (feature, scenario, etc...)
  * Improve parser
  * Improve documentation
  * Automate `language-gherkin-i18n` update by watching `gherkin-languages.json` update in its released version
  * Redo all the scrips in a more cleaner way and with Javascript
