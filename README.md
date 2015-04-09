# Gherkin language support in Atom

Gherkin language in Atom and support for:
* Syntax Coloring based on [Atom Language Gherkin](https://github.com/gigapixel/atom-language-gherkin)
* Internationalization in 60 languages based on [i18n.json](https://github.com/cucumber/gherkin/blob/master/lib/gherkin/i18n.json)
* Simple Completion (without autocomplete-plus) in 60 languages

The default way it work is Gherkin is equal Gherkin-en so when `# language: <langID>` is not specified it use English as default.
In order to use an other language parser set as first line of your feature file `# language: <langID>` like `# language: fr`.

Like explain in [Cucumber documentation for spoken languages](https://github.com/cucumber/cucumber/wiki/Spoken-languages)

List of language actually supported

|Language Name(English)|Language Name(Native)|langID|
|----------------------|---------------------|-------|
|Afrikaans|Afrikaans|af|
|Arabic|العربية|ar|
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
|Tatar|Татарча|tt|
|Telugu|తెలుగు|tl|
|Thai|ไทย|th|
|Turkish|Türkçe|tr|
|Ukrainian|Українська|uk|
|Urdu|اردو|ur|
|Uzbek|Узбекча|uz|
|Vietnamese|Tiếng Việt|vi|
|Welsh|Cymraeg|cy-GB|

Contributions are greatly appreciated. Please fork this repository and open a
pull request to add snippets, make grammar tweaks, etc.

<!--
Faire des capture en au moins 5 lang differente
![Capture #1](https://f.cloud.github.com/assets/69169/2290250/c35d867a-a017-11e3-86be-cd7c5bf3ff9b.gif)
![Capture #2](https://f.cloud.github.com/assets/69169/2290250/c35d867a-a017-11e3-86be-cd7c5bf3ff9b.gif)
![Capture #3](https://f.cloud.github.com/assets/69169/2290250/c35d867a-a017-11e3-86be-cd7c5bf3ff9b.gif)
![Capture #4](https://f.cloud.github.com/assets/69169/2290250/c35d867a-a017-11e3-86be-cd7c5bf3ff9b.gif)
![Capture #5](https://f.cloud.github.com/assets/69169/2290250/c35d867a-a017-11e3-86be-cd7c5bf3ff9b.gif)
-->

# How it is made

We have template for the grammar and autocompletion and based on [i18n.json](https://github.com/cucumber/gherkin/blob/master/lib/gherkin/i18n.json) we generate files for each language.

# ToDo

* 100% Test Coverage
* Advanced Completion (with autocomplete-plus through it [Provider Api](https://github.com/atom-community/autocomplete-plus/wiki/Provider-API)) in an other package
* Language Cucumber need to be done [Cucumber Atom](https://github.com/edda/cucumber-atom) in an other package
* Snippets for table and most used keyword(feature, scenario, etc...)
* Bench other gherkin implementation like [Cucumber Textmate Bundle](https://github.com/cucumber/cucumber-tmbundle) and the official [Gherkin BNF](https://github.com/cucumber/gherkin/wiki/BNF) and maybe used them
