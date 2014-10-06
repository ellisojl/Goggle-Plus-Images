<?php if (!defined('BASEPATH')) exit('No direct script access allowed.');

	function get_xml_array_for_url($url) {
//		$this->load->helper('xml');
		$data = array();
		$xmlDoc = new DOMDocument();
		$xmlDoc->load($url);
		if ($xmlDoc) {
			return domnode_to_array($xmlDoc->documentElement);
		}
		return array();

	}
	
	function domnode_to_array($node) {
		$output = array();
		switch ($node->nodeType) {
		case XML_CDATA_SECTION_NODE:
		case XML_TEXT_NODE:
			$output = trim($node->textContent);
			break;
		case XML_ELEMENT_NODE:
		for ($i=0, $m=$node->childNodes->length; $i<$m; $i++) { 
		 $child = $node->childNodes->item($i);
		 $v = domnode_to_array($child);
		 if(isset($child->tagName)) {
		   $t = $child->tagName;
		   if(!isset($output[$t])) {
			$output[$t] = array();
		   }
		   $output[$t][] = $v;
		 }
		 elseif($v) {
		  $output = (string) $v;
		 }
		}
		if(is_array($output)) {
		 if($node->attributes->length) {
		  $a = array();
		  foreach($node->attributes as $attrName => $attrNode) {
		   $a[$attrName] = (string) $attrNode->value;
		  }
		  $output['@attributes'] = $a;
		 }
		 foreach ($output as $t => $v) {
		  if(is_array($v) && count($v)==1 && $t!='@attributes') {
		   $output[$t] = $v[0];
		  }
		 }
		}
	   break;
	  }
	  return $output;
	}