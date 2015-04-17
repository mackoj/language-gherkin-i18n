# Gherkin language support in Atom

This `Gherkin language in Atom` plugin offers:

  * Syntax Coloring based on [Atom Language Gherkin](https://github.com/gigapixel/atom-language-gherkin)
  * Internationalization in 64 languages based on [i18n.json](https://github.com/cucumber/gherkin/blob/master/lib/gherkin/i18n.json)
  * Simple Completion (without autocomplete-plus) in 64 languages

The matching is done by looking at the very first line of each of you `.feature` files.

So to use a specific language, set the first line of your feature file with the pattern `# language: <langID>`, e.g. `# language: fr`.

When `# language: <langID>` is not specified, it defaults to English.

The source documentation is the [Cucumber documentation for spoken languages](https://github.com/cucumber/cucumber/wiki/Spoken-languages)

Syntax color best match with Atom One Dark theme.

![English / French / German / Japanese / Hebrew](http://www.macko.fr/preview.gif)

# Compatibility

  * Gherkin (2.12.2)
  * Cucumber (1.39.19 -> 2.0.0.rc.5)

# List of language actually supported

|Language Name(English)|Language Name(Native)|langID|
|----------------------|---------------------|------|
|Afrikaans|Afrikaans|af|
|Arabic|العربية|ar|
|Armenian|հայերեն|am|
|Australian|Australian|en-au|
|Bulgarian|български|bg|
|Catalan|català|ca|
|Chinese simplified|简体中文|zh-CN|
|Chinese traditional|繁體中文|zh-TW|
|Creole|kreyòl|ht|
|Croatian|hrvatski|hr|
|Czech|Česky|cs|
|Danish|dansk|da|
|Dutch|Nederlands|nl|
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
If you find a bug please consider create a issue for it to be treated for it to be treated fast consider add a test case in the scpec file in order to reproduce it.
Please fork this repository and open a pull request to add snippets, make grammar tweaks, etc.

# How it is made

Using a template for the grammar and another one for the autocompletion, we parse the [i18n.json](https://github.com/cucumber/gherkin/blob/master/lib/gherkin/i18n.json) file to generate the corresponding files for each language.

# ToDo

* Improve parser
* Snippets for table and most used keyword (feature, scenario, etc...)
* Add a better style
* Improve test coverage on the Gherkin grammar
