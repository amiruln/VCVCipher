<?php
		
class VCVCipher
{
	
	private $uAlphabet;    		// English Alphabet (UPPERCASE)
	private $lAlphabet;    		// English Alphabet (lowercase)
	function __construct()
	{
		$this->uAlphabet = range('A', 'Z');
		$this->lAlphabet = range('a', 'z');
	}
	/**
	*	EncryptOrDecrypt ()
	*   
	*	it encrypts or decrypts messages depends on the third parameter
	*
	* @param $message (string) -> User's Message
	* @param $secretMsg (string) -> User's Secret Message // Key for Vigenere Cipher
	* @param $type (string) -> ENCRYPT || DECRYPT
	*
	* @return $outputMsg (string) -> Encrypted Or Decrypted Message
	*/
	public function EncryptOrDecrypt($message, $secretMsg, $type = "ENCRYPT")
	{
		//VIGENERE CIPHER
		$secretMsg = strtolower($secretMsg);		
		/*
			if $type is DECRYPT then reverse the $secretMsg -> (26 - $secretMsg[$i]) to encrypt the message rather than decrypting it
		*/
		if ($type == 'DECRYPT') { 
			$string = '';
			for ($i = 0; $i < strlen($secretMsg); $i++) { 
				$string .= $this->lAlphabet[(26 - array_search($secretMsg[$i], $this->lAlphabet)) % 26];
			}
			$secretMsg = $string;
		}
		$vigenereencryption = ''; // final decrypted or encrypted message
		$counter = 0;
		
		for ($i = 0; $i < strlen($message); $i++) { 
			if (array_search($message[$i], $this->uAlphabet) !== false) 
			{ // if this character is uppercase character
				$vigenereencryption .= $this->uAlphabet[(array_search($secretMsg[$counter], $this->lAlphabet) + array_search($message[$i], $this->uAlphabet)) % 26]; 

			}
			elseif (array_search($message[$i], $this->lAlphabet) !== false)
			{ // if this character is lowercase character
				$vigenereencryption .= $this->lAlphabet[(array_search($secretMsg[$counter], $this->lAlphabet) + array_search($message[$i], $this->lAlphabet)) % 26];
				
			} else 
			{ // if this character is not an english alphabet characters
				$vigenereencryption.= $message[$i]; continue;
			}
			if ($counter == strlen($secretMsg) - 1) $counter = 0;
			else $counter++;
		}
		
		$encryption1 = $vigenereencryption; //vigenere encryption output
		//echo $vigenereencryption . " encryption for vigenere cipher";

		
		//CAESAR CIPHER
		$shift = 13; //declare shift key for caesar cipher, user can't change this
		$shift = ($type == "ENCRYPT") ? $shift : 26 - $shift ;
		$caesarencryption = '';
		for ($i = 0; $i < strlen($encryption1); $i++) { 
			if (array_search($encryption1[$i], $this->uAlphabet) !== false) 
			{ // if this character is uppercase character
				$caesarencryption .= $this->uAlphabet[($shift + array_search($encryption1[$i], $this->uAlphabet)) % 26]; 
			}
			elseif (array_search($encryption1[$i], $this->lAlphabet) !== false)
			{ // if this character is lowercase character
				$caesarencryption .= $this->lAlphabet[($shift + array_search($encryption1[$i], $this->lAlphabet)) % 26];
				
			} else 
			{ // if this character is not an english alphabet characters
				$caesarencryption.= $encryption1[$i]; continue;
			}
		}

		$encryption2 = $caesarencryption; //caeser encryption output
		//echo "<br>" . $caesarencryption . " encryption for caesar cipher";



		//VIGENERE CIPHER 2
		$key = 'passthiswall';  // declare key for vigenere cipher, user can't change this key
		$key = strtolower($key);		
		/*
			if $type is DECRYPT then reverse the $secretMsg -> (26 - $key[$i]) to encrypt the lastanswer rather than decrypting it
		*/
		if ($type == 'DECRYPT') { 
			$string = '';
			for ($i = 0; $i < strlen($key); $i++) { 
				$string .= $this->lAlphabet[(26 - array_search($key[$i], $this->lAlphabet)) % 26];
			}
			$key = $string;
		}
		$vigenereencryption2 = ''; // final decrypted or encrypted lastanswer
		$counter = 0;
		
		for ($i = 0; $i < strlen($encryption2); $i++) { 
			if (array_search($encryption2[$i], $this->uAlphabet) !== false) 
			{ // if this character is uppercase character
				$vigenereencryption2 .= $this->uAlphabet[(array_search($key[$counter], $this->lAlphabet) + array_search($encryption2[$i], $this->uAlphabet)) % 26]; 

			}
			elseif (array_search($encryption2[$i], $this->lAlphabet) !== false)
			{ // if this character is lowercase character
				$vigenereencryption2 .= $this->lAlphabet[(array_search($key[$counter], $this->lAlphabet) + array_search($encryption2[$i], $this->lAlphabet)) % 26];
				
			} else 
			{ // if this character is not an english alphabet characters
				$vigenereencryption2.= $encryption2[$i]; continue;
			}
			if ($counter == strlen($key) - 1) $counter = 0;
			else $counter++;
		}
		
		//echo "<br>" . $vigenereencryption2 . " encryption for vigenere cipher 2";
		return $vigenereencryption2; //last encryption / vigenere encryption 2 output
		


	}

}
?>