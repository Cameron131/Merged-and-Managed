<?php
function convert_to_xml(SimpleXMLElement $obj, array $array)
{
	$attr = "Attribute_";
	foreach ($array as $key => $attribute)
	{
		if (is_array($attribute))
		{
			$new_obj = $obj->addChild($key);
			convert_to_xml($new_obj, $attribute);
		}
		else
		{
			if(strpos($key, $attr) !== false)
			{
				$obj->addAttribute(substr($key, strlen($attr)), $attribute);
			}
			else
			{
				$obj->addChild($key, $attribute);
			}
		}
	}
}

	$test_array = array(array("name" => "Peter Parker", "email" => "peterparker@mail.com"), array("name" => "Clark Kent", "email" => "clarkkent@mail.com"), array("name" => "Harry Potter", "email" => "harrypotter@mail.com"), array("name" => "Garfield", "email" => "garfield@mail.com"));
	$xml = new SimpleXMLElement('<characters/>');

	convert_to_xml($xml, $test_array); 
	$xml_document=$xml->asXML();

	$myfile = fopen("characters.xml", "w");
	fwrite($myfile, $xml_document);
	fclose($myfile);
?>