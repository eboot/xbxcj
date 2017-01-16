<?php

 
class vdo
{
  protected $url;
  protected $title='';
  public $sources;
  protected $itag = [37,22,59,18];
  protected $vidcode = ['18'=>'360','59'=>'480','22'=>'720','37'=>'1080','82'=>'360','83'=>'240','84'=>'720','85'=>'1080'];

  public function setItag(array $itag)
  {
    $this->item = $itag;
  }

  public function setVidcode(array $vidcode)
  {
    $this->vidcode = $vidcode + $this->vidcode;
  }

  public function setTitle($title)
  {
    $this->title=$title;
  }

  public function getLink($gurl)
  {
    $source = [];
    if($this->getDriveId($gurl)){
      $body = $this->getByfopen();
      if($body && $this->getStr($body,'status=','&')==='ok'){
        $fmt = $this->getStr($body,'fmt_stream_map=','&');
        $urls = explode(',',urldecode($fmt));
        foreach ($urls as $url) {
          list($itag,$link) = explode('|',$url);
          if(in_array($itag,$this->itag)){
            $source[$this->vidcode[$itag]] = preg_replace(["/[^\/]+\.googlevideo\.com/","/ipbits=\d{2}/"],["redirector.googlevideo.com",'ipbits=0'],$link);
          }
        }
      }
    }
    $this->sources = $source;
 }
    public function getSources($type = 'videojs')
    {
      $s = [];
      $url_tag = ($type == 'videojs') ? 'src' : 'file';
      foreach ($this->sources as $itag => $link) {
        $s[] = [
          'type' => 'video/mp4',
          'label'=>$itag,
          'file'=>$link.'&title='.$itag,
          $url_tag=>$link.'&title='.$this->title.'-'.$itag
        ];
      }
      return json_encode($s);
    }

    public function getByfopen()
    {
      try{
        $handle = fopen($this->url,"r");
        if(!$handle){
          throw new \Exception('Url open failed.');
        }
        $contents = stream_get_contents($handle);
        fclose($handle);
        return $contents ? $contents : '';
      } catch( \Exception $e){
        echo 'Message: ' .$e->getMessage();
      }
    }

    private function getDriveId($url)
    {
      preg_match('/(?:https?:\/\/)?(?:[\w\-]+\.)*(?:drive|docs)\.google\.com\/(?:(?:folderview|open|uc)\?(?:[\w\-\%]+=[\w\-\%]*&)*id=|(?:folder|file|document|presentation)\/d\/|spreadsheet\/ccc\?(?:[\w\-\%]+=[\w\-\%]*&)*key=)([\w\-]{28,})/i',$url,$match);
      if(isset($match[1])){
        $this->url = 'https://docs.google.com/get_video_info?docid='.$match[1];
        return true;
      }
      return false;
    }

    private function getStr($string,$find_start,$find_end)
    {
      $start = stripos($string,$find_start);
      if($start === false) return false;
      $length = strlen($find_start);
      $end = stripos(substr($string,$start+$length),$find_end);
      if($end !=false){
        $rs = substr($string,$start+$length,$end);
      } else{
        $rs = substr($string,$start+$lenght,$end);
      }
      return $rs ? $rs : false;
    }

}

 ?>
