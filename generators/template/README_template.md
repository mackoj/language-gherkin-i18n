# Gherkin language support in Atom

This `Gherkin language in Atom` plugin offers:

  * Syntax Coloring based on [Atom Language Gherkin](https://github.com/gigapixel/atom-language-gherkin)
  * Internationalization in __NB_LANG__ languages based on [i18n.json](https://github.com/cucumber/gherkin/blob/master/lib/gherkin/i18n.json)
  * Simple Completion in __NB_LANG__ languages

The matching is done by looking at the very first line of each of you `.feature` files.

So to use a specific language, set the first line of your feature file with the pattern `# language: <langID>`, e.g. `# language: fr`.

When `# language: <langID>` is not specified, it defaults to English.

The source documentation is the [Cucumber documentation for spoken languages](https://github.com/cucumber/cucumber/wiki/Spoken-languages)

Syntax color best match with Atom One Dark theme.

![English / French / German / Japanese / Hebrew](https://github.com/mackoj/language-gherkin-i18n/blob/develop/preview.gif)

# Compatibility

  * Gherkin (2.12.2)
  * Cucumber (1.39.19 -> 2.0.0.rc.5)

# List of language actually supported

__LANG_LIST__

# Contributing

Contributions are greatly appreciated.
If you find a bug please consider create a issue for it to be treated for it to be treated fast consider add a test case in the spec file in order to reproduce it.
Please fork this repository and open a pull request to add snippets, make grammar tweaks, etc.

# How it is made

Using a template for the grammar and another one for the autocompletion, we parse the [i18n.json](https://github.com/cucumber/gherkin/blob/master/lib/gherkin/i18n.json) file to generate the corresponding files for each language.

# ToDo

  * Add unit test
  * Add Snippets for table and most used keyword (feature, scenario, etc...)
  * Improve parser
  * Improve documentation
  * Automate `language-gherkin-i18n` update by watching `i18n.json` update in released version
