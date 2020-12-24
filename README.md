# i18n-Auto-Google-Translator
A PHP script to translate all i18n strings using Google Translate
<h2>Usage</h2>
  <code>php -f translator.php languageFile=xx.json fromLanguage=xx toLanguages[]=xx toLanguages[]=xx ...</code>
  <h3>Parameters</h3>
  <code>languageFile</code><h5>Path to the xx.json file for source language. example: ~/en.json</h5><code>String (Path)</code><br>
  <code>fromLanguage</code><h5>Iso language code of the source file. example: en <code>String (Language Code)</h5></code><br>
  <code>toLanguages</code><h5>Array of destination languages. example: ~/en.json <code>Array (Language Code)</h5></code><br>
  <h3>Example</h3>
  <code>php -f translator.php languageFile=~/en.json fromLanguage=en toLanguages[]=fr toLanguages[]=hi ...</code>
