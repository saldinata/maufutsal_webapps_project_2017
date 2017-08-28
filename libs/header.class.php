<?php
	
	class Header
	{
		
		private $data;
		private $keyWord;
		private $author;
		private $author_dec;
		private $title_apps;
		private $favicon_path;
		
		public function getMetaInformation ()
		{
			$this -> data = "<meta charset=\"utf-8\">";
			$this -> data .= "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\">";
			$this -> data .= "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0, maximum-scale=1\">";
			$this -> data .= "<meta name=\"description\" content=\"-\">";
			$this -> data .= "<meta name=\"maufutsal\" content=\"maufutsal\">";
			$this -> data .= "<meta name = \"format-detection\" content = \"telephone=no\" >";
			
			return $this -> data;
		}
		
		public function getKeyword ()
		{
			return $data
				= "<meta name=\"keywords\" content=\"$this->keyWord\">";
		}
		
		public function setKeyword ( $content )
		{
			$this -> keyWord = $content;
		}
		
		public function setAuthorInfo ( $author , $content )
		{
			$this -> author     = $author;
			$this -> author_dec = $content;
		}
		
		public function getAuthorInfo ()
		{
			return $this -> data
				= "<meta name = \"$this->author\" content = \"$this->author_dec\">";
		}
		
		public function getXUACimpatible ()
		{
			return $data
				= "<meta http-equiv=\"X-UA-Compatible\" content=\"IE=edge\">";
		}
		
		public function setTitle ( $title )
		{
			$this -> title_apps = $title;
		}
		
		public function getTitle ()
		{
			return $data = "<title>$this->title_apps</title>";
		}
		
		public function setFavicon ( $path )
		{
			$this -> favicon_path = $path;
		}
		
		public function getFavicon ()
		{
			return $data
				= "<link rel=\"shortcut icon\" href=\"$this->favicon_path\">";
		}
		
		
		public function getWebFont ()
		{
			return $this -> data = null;
		}
		
		public function getStyleLink ()
		{
			$this -> data = "<link href=\"css/bootstrap.css\" rel=\"stylesheet\">";
			$this -> data .= "<link href=\"css/font-awesome.css\" rel=\"stylesheet\">";
			$this -> data .= "<link href=\"css/flaticon.css\" rel=\"stylesheet\">";
			$this -> data .= "<link href=\"css/slick-slider.css\" rel=\"stylesheet\">";
			$this -> data .= "<link href=\"css/fancybox.css\" rel=\"stylesheet\">";
			$this -> data .= "<link href=\"style.css\" rel=\"stylesheet\">";
			$this -> data .= "<link href=\"css/color.css\" rel=\"stylesheet\">";
			$this -> data .= "<link href=\"css/responsive.css\" rel=\"stylesheet\">";
			
			return $this -> data;
		}
		
		
		public function getStyleLinkInternal ()
		{
			$this -> data
				          = "<link rel = \"stylesheet\" type = \"text/css\" href = \"../css/bootstrap.min.css\" >";
			$this -> data .= "<link rel = \"stylesheet\" type = \"text/css\" href = \"../css/fontawesome/css/font-awesome.min.css\" />";
			$this -> data
				          .= "<link rel = \"stylesheet\" type = \"text/css\" href = \"../css/owl.carousel.css\" >";
			$this -> data .= "<link rel = \"stylesheet\" type = \"text/css\" href = \"../css/bootstrap-select.min.css\" >";
			$this -> data .= "<link rel = \"stylesheet\" type = \"text/css\" href = \"../css/magnific-popup.css\" >";
			$this -> data .= "<link rel = \"stylesheet\" type = \"text/css\" href = \"../css/style.css\" >";
			$this -> data .= "<link class = \"skin\" rel = \"stylesheet\" type = \"text/css\" href = \"../css/skin/skin-1.css\" >";
			$this -> data .= "<link rel = \"stylesheet\" type = \"text/css\"  href = \"../css/templete.css\" >";
			$this -> data .= "<link rel = \"stylesheet\" type = \"text/css\" href = \"../css/switcher.css\" >";
			$this -> data .= "<link rel = \"stylesheet\" type = \"text/css\" href = \"../plugins/revolution/revolution/css/settings.css\" >";
			$this -> data .= "<link rel = \"stylesheet\" type = \"text/css\" href = \"../plugins/revolution/revolution/css/navigation.css\" >";
			$this -> data .= "<link rel = \"stylesheet\" type = \"text/css\" href = \"../plugins/revolution/revolution/css/settings.css\" >";
			$this -> data .= "<link rel = \"stylesheet\" type = \"text/css\" href = \"../plugins/revolution/revolution/css/navigation.css\" >";
			
			return $this -> data;
		}
		
		public function getAdditionStyle ()
		{
			$this -> data
				= "<link rel = \"stylesheet\" type = \"text/css\" href = \"../css/css-slide.css\" >";
			$this -> data
				= "<link rel = \"stylesheet\" type = \"text/css\" href = \"../plugins/scroll/scrollbar.html\" >";
			
			return $this -> data;
		}
		
		
		public function getScript ()
		{
			$this -> data = "<script src = \"js/html5shiv.min.js\" ></script >";
			$this -> data .= "<script src = \"js/respond.min.js\" ></script >";
			
			return $this -> data;
		}
		
	}

?>
