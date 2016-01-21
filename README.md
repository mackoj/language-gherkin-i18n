# Gherkin language support in Atom

This `Gherkin language in Atom` plugin offers:

  * Syntax Coloring based on [Atom Language Gherkin](https://github.com/gigapixel/atom-language-gherkin)
  * Internationalization in 68 languages based on [gherkin-languages.json](https://github.com/cucumber/gherkin/blob/master/gherkin-languages.json)
  * Simple Completion in 68 languages

The languages matching is done by looking at the very first line of each of the `.feature` files.

In order to use a specific language, set the first line of your feature file with the following pattern:  `# language: <langID>`, e.g. `# language: fr`.

When `# language: <langID>` is not specified, it defaults to English.

The source documentation is the [Cucumber documentation for spoken languages](https://github.com/cucumber/cucumber/wiki/Spoken-languages)

Syntax color works better with Atom One Dark theme.

![English / French / German / Japanese / Hebrew](https://github.com/mackoj/language-gherkin-i18n/blob/develop/preview.gif)

# Compatibility

  * Gherkin (3.2.0)

# List of supported languages

|Language Name(English)|Language Name(Native)|langID|
|----------------------|---------------------|------|
|Afrikaans|Afrikaans|af|
|Arabic|العربية|ar|
|Armenian|հայերեն|am|
|Australian|Australian|en-au|
|Bosnian|Bosanski|bs|
|Bulgarian|български|bg|
|Catalan|català|ca|
|Chinese simplified|简体中文|zh-CN|
|Chinese traditional|繁體中文|zh-TW|
|Creole|kreyòl|ht|
|Croatian|hrvatski|hr|
|Czech|Česky|cs|
|Danish|dansk|da|
|Dutch|Nederlands|nl|
|Emoji|😀|em|
|English|English|en|
|Esperanto|Esperanto|eo|
|Estonian|eesti keel|et|
|Finnish|suomi|fi|
|French|français|fr|
|Galician|galego|gl|
|German|Deutsch|de|
|Greek|Ελληνικά|el|
|Gujarati|ગુજરાતી|gj|
|Hebrew|עברית|he|
|Hindi|हिंदी|hi|
|Hungarian|magyar|hu|
|Icelandic|Íslenska|is|
|Indonesian|Bahasa Indonesia|id|
|Irish|Gaeilge|ga|
|Italian|italiano|it|
|Japanese|日本語|ja|
|Javanese|Basa Jawa|jv|
|Kannada|ಕನ್ನಡ|kn|
|Klingon|tlhIngan|tlh|
|Korean|한국어|ko|
|LOLCAT|LOLCAT|en-lol|
|Latvian|latviešu|lv|
|Lithuanian|lietuvių kalba|lt|
|Luxemburgish|Lëtzebuergesch|lu|
|Malay|Bahasa Melayu|bm|
|Mongolian|монгол|mn|
|Norwegian|norsk|no|
|Old English|Englisc|en-old|
|Panjabi|ਪੰਜਾਬੀ|pa|
|Persian|فارسی|fa|
|Pirate|Pirate|en-pirate|
|Polish|polski|pl|
|Portuguese|português|pt|
|Romanian|română|ro|
|Russian|русский|ru|
|Scouse|Scouse|en-Scouse|
|Serbian (Latin)|Srpski (Latinica)|sr-Latn|
|Serbian|Српски|sr-Cyrl|
|Slovak|Slovensky|sk|
|Slovenian|Slovenski|sl|
|Spanish|español|es|
|Swedish|Svenska|sv|
|Tamil|தமிழ்|ta|
|Tatar|Татарча|tt|
|Telugu|తెలుగు|tl|
|Thai|ไทย|th|
|Turkish|Türkçe|tr|
|Ukrainian|Українська|uk|
|Urdu|اردو|ur|
|Uzbek|Узбекча|uz|
|Vietnamese|Tiếng Việt|vi|
|Welsh|Cymraeg|cy-GB|

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
