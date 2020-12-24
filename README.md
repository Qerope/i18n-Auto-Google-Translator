# i18n-Auto-Google-Translator
A PHP script to translate all i18n strings using Google Translate
<h2>Usage</h2>
  <code>php translator.php languageFile fromLanguage toLanguages</code>
  <h3>Parameters</h3>
  <h5><code>languageFile</code>Path to the xx.json file for source language. example: ~/en.json<code>String (Path)</h5></code>
  <h5><code>fromLanguage</code>Iso language code of the source file. example: en <code>String (Language Code)</h5></code>
  <h5><code>toLanguages</code>Array of destination languages seperated by ",". example: fr,hi,de,nl,zh <code>String (Language Code)</h5></code>
  <h3>Example</h3>
  <code>php translator.php ~/en.json en hi,fr</code>
