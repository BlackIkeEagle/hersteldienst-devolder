<?php
/**
 * Text Input and Output CLASS
 *
 * @author Ike Devolder <devolderike@yahoo.com>
 * @version $Id, class.textio , v1.1.2 , 2007/02/15 - 2007/12/19
 */

class textio {
  private $bbcodeen;

  private $bbcodein = array(
    '`\[h1\](.+?)\[/h1\]`is',
    '`\[h2\](.+?)\[/h2\]`is',
    '`\[p\](.+?)\[/p\]`is',
    '`\[b\](.+?)\[/b\]`is',
    '`\[i\](.+?)\[/i\]`is',
    '`\[u\](.+?)\[/u\]`is',
    '`\[center\](.+?)\[/center\]`is',
    '`\[block\](.+?)\[/block\]`is',
    '`\[blockr\](.+?)\[/blockr\]`is',
    '`\[strike\](.+?)\[/strike\]`is',
    '`\[color=#([0-9]{6})\](.+?)\[/color\]`is',
    '`\[email\](.+?)\[/email\]`is',
    '`\[img\](.+?)\[/img\]`is',
    '`\[url=([a-z0-9]+://)([\w\-]+\.([\w\-]+\.)*[\w]+(:[0-9]+)?(/[^ \"\n\r\t<]*?)?)\](.*?)\[/url\]`si',
    '`\[url=//(.*?)\](.*?)\[/url\]`si' ,
    '`\[url=(.*?)\](.*?)\[/url\]`si' ,
    '`\[url\]([a-z0-9]+?://){1}([\w\-]+\.([\w\-]+\.)*[\w]+(:[0-9]+)?(/[^ \"\n\r\t<]*)?)\[/url\]`si',
    '`\[url\]((www|ftp)\.([\w\-]+\.)*[\w]+(:[0-9]+)?(/[^ \"\n\r\t<]*?)?)\[/url\]`si',
    '`\[link=([a-z0-9]+://)([\w\-]+\.([\w\-]+\.)*[\w]+(:[0-9]+)?(/[^ \"\n\r\t<]*?)?);(.*?)\](.*?)\[/link\]`si',
    '`\[flash=([0-9]+),([0-9]+)\](.+?)\[/flash\]`is',
    '`\[quote\](.+?)\[/quote\]`is',
    '`\[indent](.+?)\[/indent\]`is',
  );
  private $bbcodeout = array(
    '<h1>\\1</h1>',
    '<h2>\\1</h2>',
    '<p>\\1</p>',
    '<strong>\\1</strong>',
    '<em>\\1</em>',
    '<span style="border-bottom: 1px dotted">\\1</span>',
    '<p style="text-align=center;margin-left:auto;margin-right:auto;">\\1</p>',
    '<div class="block">\\1</div>',
    '<div class="blockr">\\1</div>',
    '<strike>\\1</strike>',
    '<span style="color:#\1;">\2</span>',
    '<a href="mailto:\1">\1</a>',
    '<img src="\1" alt="" style="border:0px;" />',
    '<a href="\1\2" target="_blank">\6</a>',
    '<a href="file://\1" target="_blank">\2</a>' ,
    '<a href="\1" target="_blank">\2</a>',
    '<a href="\1\2" target="_blank">\1\2.</a>',
    '<a href="http://\1" target="_blank">\1.</a>',
    '<span class="link" onclick="getData(\'\1\2\',\'\6\')">\7</span>',
    '<object width="\1" height="\2"><param name="movie" value="\3" /><embed src="\3" width="\1" height="\2"></embed></object>',
    '<strong>Quote:</strong><div style="margin:0px 10px;padding:5px;background-color:#F7F7F7;border:1px dotted #CCCCCC;width:80%;"><em>\1</em></div>',
    '<pre>\\1</pre>',
  );

  private $smileysen;
  private $smileydir;

  private $smileytxt = array ( 
    array ( "8-)" , "8)" ) , 
    array ( "8-O" , "8O" , "8o" ) , 
    array ( ":-(" , ":(" ) ,
    array ( ":-)" , ":)" ) ,
    array ( "=-)" , "=)" ) ,
    array ( ":-/" , ":/ " ) , 
    array ( ":-\\" , ":\\" ) , 
    array ( ":-?" , ":? " ) , 
    array ( ":-D" , ":-d" , ":D" , ":d" ) , 
    array ( ":-P" , ":-p" , ":P" , ":p" ) ,
    array ( ":-O" , ":-o" , ":O " , ":o " ) ,
    array ( ":-X" , ":-x" , ":X" , ":x" ) ,
    array ( ":-|" , ":|" ) ,
    array ( ";-)" , ";)" ) , 
    "^_^" , 
    ":?:" , 
    ":!:" , 
    array ( "LOL" , ":lol:" ) ,
    array ( ":evil:" , ":-@" , ":@" ) ,
    ":twisted:" ,
    ":oops:" ,
    ":roll:" ,
    ":idea:" ,
    ":bday:" ,
    ":mrgreen:" ,
    ":evilbat:" ,
    array ( "ROFL" , "ROFLOL" , ":rofl:" , ":roflol:" )
  );
  private $smileyimg = array (
    "icon_cool.gif" ,
    "icon_eek.gif" ,
    "icon_sad.gif" ,
    "icon_smile.gif" ,
    "icon_smile2.gif" ,
    "icon_doubt.gif" ,
    "icon_doubt2.gif" ,
    "icon_confused.gif" ,
    "icon_biggrin.gif" ,
    "icon_razz.gif" ,
    "icon_surprised.gif" ,
    "icon_silenced.gif" ,
    "icon_neutral.gif" ,
    "icon_wink.gif" ,
    "icon_fun.gif" ,
    "icon_question.gif" ,
    "icon_exclaim.gif" ,
    "icon_lol.gif" ,
    "icon_evil.gif" ,
    "icon_twisted.gif" ,
    "icon_oops.gif" ,
    "icon_rolleyes.gif" ,
    "icon_idea.gif" ,
    "icon_birthday.gif" ,
    "icon_mrgreen.gif" ,
    "icon_evilbat.gif" ,
    "icon_roflol.gif"
  ); 

  /**
   * CONSTRUCTOR
   * The constructor takes settings for the text manipulation
   *
   * @param  $bbcode          true or false
   * @param  $smileys         true or false
   * @param  $smileydir       required if $smileys is set true
   */
  function __construct( $bbcode = true , $smileys = false , $smileydir="" ) {
    $this->bbcodeen = is_bool( $bbcode ) ? $bbcode : true;
    $this->smileysen = is_bool( $smileys ) && $smileydir != "" ? $smileys : false;
    $this->smileydir = $smileydir;
  }

  /**
   * function textin
   * this function prepares the inputstring for storage in a database
   *
   * @param string  input string for example coming from a input box
   *
   * @return string  special chars, nohtml allowed
   */
  public function textin( $string ) {
    if( ! $string ) { return false; }
    $string = $this->disablehtml( $string );
    $string = $this->repspecchars( $string );
    return $string;
  }

  /**
   * following functions will be needed by textin
   */

  /**
   * function disablehtml
   * this function will rip out the html-tags in the input string
   *
   * @param string  input where to strip out html
   *
   * @return string
   */
  private function disablehtml( $string ) {
    if( ! $string ) { return false; }
    return strip_tags( $string );
  }

  /**
   * function replacespecialchars
   * this function wil replace some special chars who could interfear with
   * correct validation
   *
   * @param string  string where to replace the special chars
   *
   * @return string
   */
  private function repspecchars( $string ) {
    if( ! $string ) { return false; }
    return preg_replace( array( '/</' , '/>/' , '/"/' , '/\'/' ) , array( '&lt;' , '&gt;' , '&quot;' , '&#39;' ) , $string );
  }

  /**
   * function textout
   * this function makes database text readable for browsers
   *
   * @param string  the string who needs manipulation
   *
   * @return string
   */
  public function textout( $string ) {
    if( ! $string) { return false; }
    if( $this->bbcodeen ) { $string = $this->bbcode( $string ); }
    if( $this->smileysen ) { $string = $this->smileys( $string ); }
    return $this->cutlongtext( $string );
  }

  /**
   * following functions will be needed by textout
   */

  /**
   * functoin bbcode
   * this function parses bbcode
   *
   * @param string
   *
   * @return string
   */ 
  private function bbcode( $string ) {
    if( ! $string ) { return false; }
    $string = nl2br( $string );
    $string = str_replace( '\\' , '/' , $string );
    $string = preg_replace( $this->bbcodein , $this->bbcodeout , $string );
    return $string;
  }

  /**
   * function smileys
   * this function wil replace known smileys with images
   *
   * @param string
   *
   * @return string  (text replaced by smileys)
   */
  private function smileys( $string ) {
    if( ! $string ) { return false; }
    $outfr = "<img src='$this->smileydir/";
    $outbk = "' alt='smiley' />";
    for ( $x = 0; $x < count( $this->smileytxt ); $x++) {
      $string = str_replace( $this->smileytxt[$x] , $outfr.$this->smileyimg[$x].$outbk , $string);
    }      
    return $string;
  }

  /**
   * function cutlongtext
   * to keep the website's design somewhat intact we might need to cut some text
   *
   * @param string
   *
   * @return string  ( where to long continuous text is cut )    
   */
  private function cutlongtext( $string ) {
    if( ! $string ) { return false; }
    foreach( explode( " " , strip_tags( $string ) ) as $key => $line) {
      $line = trim( $line );
      if( strlen( $line ) > 60 ) {
        $string = str_replace( $line , substr($line,0,55)."..." , $string );
      }
    }
    return $string;
  }

}
?>
