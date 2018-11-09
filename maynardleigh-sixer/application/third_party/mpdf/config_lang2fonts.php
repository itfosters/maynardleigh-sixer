<?php

function GetLangOpts($llcc, $adobeCJK, &$fontdata)
{
	$tags = preg_split('/-/', $llcc);
	$lang = strtolower($tags[0]);
	$country = '';
	$script = '';
	if (isset($tags[1]) && $tags[1]) {
		if (strlen($tags[1]) == 4) {
			$script = strtolower($tags[1]);
		} else {
			$country = strtolower($tags[1]);
		}
	}
	if (isset($tags[2]) && $tags[2]) {
		$country = strtolower($tags[2]);
	}

	$unifont = "";
	$coreSuitable = false;

	switch ($lang) {

		/* European */
		CASE "en": CASE "eng": // English		// LATIN
		CASE "eu": CASE "eus": // Basque
		CASE "sk": CASE "slk": // Slovak
			$unifont = "dejavusanscondensed";
			// Edit this value to define how mPDF behaves when using new mPDF('-x')
			// If set to TRUE, mPDF will use Adobe core fonts only when it recognises the languages above
			$coreSuitable = true;
			break;

		CASE "ru": CASE "rus": // Russian	// CYRILLIC
		CASE "ab": CASE "abk": // Abkhaz
		CASE "av": CASE "ava": // Avaric
		CASE "ba": CASE "bak": // Bashkir
		CASE "be": CASE "bel": // Belarusian
		CASE "bg": CASE "bul": // Bulgarian
		CASE "ce": CASE "che": // Chechen
		CASE "cv": CASE "chv": // Chuvash
		CASE "kk": CASE "kaz": // Kazakh
		CASE "kv": CASE "kom": // Komi
		CASE "ky": CASE "kir": // Kyrgyz
		CASE "mk": CASE "mkd": // Macedonian
		CASE "cu": CASE "chu": // Old Church Slavonic
		CASE "os": CASE "oss": // Ossetian
		CASE "sr": CASE "srp": // Serbian
		CASE "tg": CASE "tgk": // Tajik
		CASE "tt": CASE "tat": // Tatar
		CASE "tk": CASE "tuk": // Turkmen
		CASE "uk": CASE "ukr": // Ukrainian
			$unifont = "dejavusanscondensed"; /* freeserif best coverage for supplements etc. */
			break;

		CASE "hy": CASE "hye": // ARMENIAN
			$unifont = "dejavusans";
			break;
		CASE "ka": CASE "kat": // GEORGIAN
			$unifont = "dejavusans";
			break;

		CASE "el": CASE "ell": // GREEK
			$unifont = "dejavusanscondensed";
			break;
		CASE "cop":  // COPTIC
			$unifont = "quivira";
			break;

		CASE "got":  // GOTHIC
			$unifont = "freeserif";
			break;

		/* African */
		CASE "nqo":  // NKO
			$unifont = "dejavusans";
			break;
		//CASE "bax":	// BAMUM
		//CASE "ha":  CASE "hau":	// Hausa
		CASE "vai":  // VAI
			$unifont = "freesans";
			break;
		CASE "am": CASE "amh": // Amharic ETHIOPIC
		CASE "ti": CASE "tir": // Tigrinya ETHIOPIC
			$unifont = "abyssinicasil";
			break;



		/* Middle Eastern */
		CASE "ar": CASE "ara": // Arabic	NB Arabic text identified by Autofont will be marked as und-Arab
			$unifont = "xbriyaz";
			break;
		CASE "fa": CASE "fas": // Persian (Farsi)
			$unifont = "xbriyaz";
			break;
		CASE "ps": CASE "pus": // Pashto
			$unifont = "xbriyaz";
			break;
		CASE "ku": CASE "kur": // Kurdish
			$unifont = "xbriyaz";
			break;
		CASE "ur": CASE "urd": // Urdu
			$unifont = "xbriyaz";
			break;
		CASE "he": CASE "heb": // HEBREW
		CASE "yi": CASE "yid": // Yiddish
			$unifont = "taameydavidclm"; // dejavusans,dejavusanscondensed,freeserif are fine if you do not need cantillation marks
			break;


		CASE "syr":  // SYRIAC
			$unifont = "estrangeloedessa";
			break;


		//CASE "arc":	// IMPERIAL_ARAMAIC
		//CASE ""ae:	// AVESTAN
		CASE "xcr":  // CARIAN
			$unifont = "aegean";
			break;
		CASE "xlc":  // LYCIAN
			$unifont = "aegean";
			break;
		CASE "xld":  // LYDIAN
			$unifont = "aegean";
			break;
		//CASE "mid":	// MANDAIC
		//CASE "peo":	// OLD_PERSIAN
		CASE "phn":  // PHOENICIAN
			$unifont = "aegean";
			break;
		//CASE "smp":	// SAMARITAN
		CASE "uga":  // UGARITIC
			$unifont = "aegean";
			break;


		/* Central Asian */
		CASE "bo": CASE "bod": // TIBETAN
		CASE "dz": CASE "dzo": // Dzongkha
			$unifont = "jomolhari";
			break;
		//CASE "mn":  CASE "mon":	// MONGOLIAN	(Vertical script)
		//CASE "ug":  CASE "uig":	// Uyghur
		//CASE "uz":  CASE "uzb":	// Uzbek
		//CASE "az":  CASE "azb":	// South Azerbaijani


		/* South Asian */
		CASE "as": CASE "asm": // Assamese
			$unifont = "freeserif";
			break;
		CASE "bn": CASE "ben": // BENGALI; Bangla
			$unifont = "freeserif";
			break;
		CASE "ks": CASE "kas": // Kashmiri
			$unifont = "freeserif";
			break;
		CASE "hi": CASE "hin": // Hindi	DEVANAGARI
		CASE "bh": CASE "bih": // Bihari (Bhojpuri, Magahi, and Maithili)
		CASE "sa": CASE "san": // Sanskrit
			$unifont = "freeserif";
			break;
		CASE "gu": CASE "guj": // Gujarati
			$unifont = "freeserif";
			break;
		CASE "pa": CASE "pan": // Panjabi, Punjabi GURMUKHI
			$unifont = "freeserif";
			break;
		CASE "kn": CASE "kan": // Kannada
			$unifont = "lohitkannada";
			break;
		CASE "mr": CASE "mar": // Marathi
			$unifont = "freeserif";
			break;
		CASE "ml": CASE "mal": // MALAYALAM
			$unifont = "freeserif";
			break;
		CASE "ne": CASE "nep": // Nepali
			$unifont = "freeserif";
			break;
		CASE "or": CASE "ori": // ORIYA
			$unifont = "freeserif";
			break;
		CASE "si": CASE "sin": // SINHALA
			$unifont = "kaputaunicode";
			break;
		CASE "ta": CASE "tam": // TAMIL
			$unifont = "freeserif";
			break;
		CASE "te": CASE "tel": // TELUGU
			$unifont = "pothana2000";
			break;


		// Sindhi (Arabic or Devanagari)
		CASE "sd": CASE "snd": // Sindhi
			if ($country == "IN") {
				$unifont = "freeserif";
			} else if ($country == "PK") {
				$unifont = "lateef";
			} else {
				$unifont = "lateef";
			}
			break;


		//CASE "ccp":	// CHAKMA
		//CASE "lep":	// LEPCHA
		CASE "lif":  // LIMBU
			$unifont = "sun-exta";
			break;
		//CASE "sat":	// OL_CHIKI
		//CASE "saz":	// SAURASHTRA
		CASE "syl":  // SYLOTI_NAGRI
			$unifont = "mph2bdamase";
			break;
		//CASE "dgo":	// TAKRI
		CASE "dv": CASE "div": // Divehi; Maldivian  THAANA
			$unifont = "freeserif";
			break;



		/* South East Asian */
		CASE "km": CASE "khm": // KHMER
			$unifont = "khmeros";
			break;
		CASE "lo": CASE "lao": // LAO
			$unifont = "dhyana";
			break;
		CASE "my": CASE "mya": // MYANMAR Burmese
			$unifont = "tharlon"; // zawgyi-one is non-unicode compliant but in wide usage
			// ayar is also not strictly compliant
			// padaukbook is unicode compliant
			break;
		CASE "th": CASE "tha": // THAI
			$unifont = "garuda";
			break;



		// VIETNAMESE
		CASE "vi": CASE "vie": // Vietnamese
			$unifont = "dejavusanscondensed";
			break;


		//CASE "ms":  CASE "msa":	// Malay
		//CASE "ban":	// BALINESE
		//CASE "bya":	// BATAK
		CASE "bug":  // BUGINESE
			$unifont = "freeserif";
			break;
		//CASE "cjm":	// CHAM
		//CASE "jv":	// JAVANESE
		CASE "su":  // SUNDANESE
			$unifont = "sundaneseunicode";
			break;
		CASE "tdd":  // TAI_LE
			$unifont = "tharlon";
			break;
		CASE "blt":  // TAI_VIET
			$unifont = "taiheritagepro";
			break;


		/* Phillipine */
		CASE "bku":  // BUHID
			$unifont = "quivira";
			break;
		CASE "hnn":  // HANUNOO
			$unifont = "quivira";
			break;
		CASE "tl":  // TAGALOG
			$unifont = "quivira";
			break;
		CASE "tbw":  // TAGBANWA
			$unifont = "quivira";
			break;


		/* East Asian */
		CASE "zh": CASE "zho": // Chinese
			if ($country == "HK" || $country == "TW") {
				if ($adobeCJK) {
					$unifont = "big5";
				} else {
					$unifont = "sun-exta";
				}
			} else if ($country == "CN") {
				if ($adobeCJK) {
					$unifont = "gb";
				} else {
					$unifont = "sun-exta";
				}
			} else {
				if ($adobeCJK) {
					$unifont = "gb";
				} else {
					$unifont = "sun-exta";
				}
			}
			break;
		CASE "ko": CASE "kor": // HANGUL Korean
			if ($adobeCJK) {
				$unifont = "uhc";
			} else {
				$unifont = "unbatang";
			}
			break;
		CASE "ja": CASE "jpn": // Japanese HIRAGANA KATAKANA
			if ($adobeCJK) {
				$unifont = "sjis";
			} else {
				$unifont = "sun-exta";
			}
			break;
		CASE "ii": CASE "iii": // Nuosu; Yi
			if ($adobeCJK) {
				$unifont = "gb";
			} else {
				$unifont = "sun-exta";
			}
		CASE "lis":  // LISU
			$unifont = "quivira";
			break;



		/* American */
		CASE "chr":  // CHEROKEE
		CASE "oj": CASE "oji": // Ojibwe; Chippewa
		CASE "cr": CASE "cre": // Cree CANADIAN_ABORIGINAL
		CASE "iu": CASE "iku": // Inuktitut
			$unifont = "aboriginalsans";
			break;


		/* Undetermined language - script used */
		CASE "und":

			switch ($script) {

				/* European */
				CASE "latn": // LATIN
					$unifont = "dejavusanscondensed";
					break;
				CASE "cyrl": // CYRILLIC
					$unifont = "dejavusanscondensed"; /* freeserif best coverage for supplements etc. */
					break;
				CASE "cprt": // CYPRIOT
					$unifont = "aegean";
					break;
				CASE "glag": // GLAGOLITIC
					$unifont = "mph2bdamase";
					break;
				CASE "linb": // LINEAR_B
					$unifont = "aegean";
					break;
				CASE "ogam": // OGHAM
					$unifont = "dejavusans";
					break;
				CASE "ital": // OLD_ITALIC
					$unifont = "aegean";
					break;
				CASE "runr": // RUNIC
					$unifont = "sun-exta";
					break;
				CASE "shaw": // SHAVIAN
					$unifont = "mph2bdamase";
					break;

				/* African */
				CASE "egyp": // EGYPTIAN_HIEROGLYPHS
					$unifont = "aegyptus";
					break;
				CASE "ethi": // ETHIOPIC
					$unifont = "abyssinicasil";
					break;
				//CASE "merc":	// MEROITIC_CURSIVE
				//CASE "mero":	// MEROITIC_HIEROGLYPHS
				CASE "osma": // OSMANYA
					$unifont = "mph2bdamase";
					break;
				CASE "tfng": // TIFINAGH
					$unifont = "dejavusans";
					break;

				/* Middle Eastern */
				CASE "arab":  // ARABIC
					$unifont = "xbriyaz";
					break;
				CASE "xsux": // CUNEIFORM
					$unifont = "akkadian";
					break;
				//CASE "sarb":	// OLD_SOUTH_ARABIAN
				//CASE "prti":	// INSCRIPTIONAL_PARTHIAN
				//CASE "phli":	// INSCRIPTIONAL_PAHLAVI


				/* Central Asian */
				//CASE "orkh":	// OLD_TURKIC
				//CASE "phag":	// PHAGS_PA		(Vertical script)

				/* South Asian */
				//CASE "brah":	// BRAHMI
				//CASE "kthi":	// KAITHI
				CASE "khar": // KHAROSHTHI
					$unifont = "mph2bdamase";
					break;
				CASE "mtei": // MEETEI_MAYEK
					$unifont = "eeyekunicode";
					break;
				//CASE "shrd":	// SHARADA
				//CASE "sora":	// SORA_SOMPENG

				/* South East Asian */
				CASE "kali": // KAYAH_LI
					$unifont = "freemono";
					break;
				//CASE "rjng":	// REJANG
				CASE "lana": // TAI_THAM
					$unifont = "lannaalif";
					break;
				CASE "talu": // NEW_TAI_LUE
					$unifont = "daibannasilbook";
					break;

				/* East Asian */
				CASE "hans": // HAN (SIMPLIFIED)
					if ($adobeCJK) {
						$unifont = "gb";
					} else {
						$unifont = "sun-exta";
					}
					break;
				CASE "bopo": // BOPOMOFO
					$unifont = "sun-exta";
					break;
				//CASE "plrd":	// MIAO
				CASE "yiii": // YI
					$unifont = "sun-exta";
					break;

				/* American */
				CASE "dsrt": // DESERET
					$unifont = "mph2bdamase";
					break;

				/* Other */
				CASE "brai": // BRAILLE
					$unifont = "dejavusans";
					break;
			} // endswitch
			break;
	} // endswitch


	return array($coreSuitable, $unifont);
}
