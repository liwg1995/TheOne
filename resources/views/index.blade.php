@extends('master')
@section('title')
  TheyOne
@stop
@section('content')
<main class="main" id="main">
  <div class="banner">
    <div id="myCarousel" class="carousel slide">
      <div class="carousel-inner">
        <div class="item"  >
          <img src="img/banner-1.jpg" alt="" >
          <div class="carousel-caption">
            <h4></h4>
            <p></p>
          </div>
        </div>
        <div class="item active">
          <img src="img/banner-2.jpg" alt="">
          <div class="carousel-caption">
            <h4></h4>
            <p></p>
          </div>
        </div>
        <div class="item">
          <img src="img/banner-3.jpg" alt="">
          <div class="carousel-caption">
            <h4></h4>
            <p></p>
          </div>
        </div>
      </div>
      <a id="carousel-left-a-lg"  class="left carousel-control hidden-xs"  data-slide="prev" href="#myCarousel" style=""><span style="" id="carousel-left-span-lg">&lsaquo;</span></a>
      <a id="carousel-right-a-lg" class="right carousel-control hidden-xs" data-slide="next" href="#myCarousel" style=""><span style="" id="carousel-right-span-lg" class="pull-right" >&rsaquo;</span></a>

    </div>
  </div>


  <div class="features hidden-xs">
      <div class="container text-center">
        <div class="col-lg-4 col-xs-4">
          <img src="img/feature-1.png">
          <h3>提问</h3>
        </div>
        <div class="col-lg-4 col-xs-4">
          <img src="img/feature-2.png">
          <h3>课程</h3>
        </div>
        <div class="col-lg-4 col-xs-4">
          <img src="img/feature-3.png">
         <h3>交流</h3>
        </div>
      </div>

  </div>

  <div class="features-xs visible-xs">
    <div class="container text-center">
      <div class="col-xs-4">
        <img src="img/feature-1.png">
        <h4>提问</h4>
      </div>
      <div class="col-xs-4">
        <img src="img/feature-2.png">
        <h4>课程</h4>
      </div>
      <div class="col-xs-4">
        <img src="img/feature-3.png">
        <h4>交流</h4>
      </div>
    </div>

  </div>


  <div class="features-info hidden-xs">
      <div class="container-fluid ">



        <div class="container-fluid" style="background-color: #ebebeb;">
          <div class="col-lg-11 col-lg-offset-1 features-info-left text-center" style="background-image: url('img/ps.png');">
             <div class="col-lg-6  col-lg-offset-5 col-md-7  col-md-offset-4 col-xs-7 col-xs-offset-4">
               <h2 style="color:#aaaaaa">
                 PS
               </h2>
               <p style="color: #aaaaaa">
                 1987年，Photoshop的主要设计师托马斯·诺尔买了一台苹果计算机（MacPlus）用来帮助他的博士论文。与此同时，Thomas发现当时的苹果计算机无法显示带灰度的黑白图像，因此他自己写了一个程序Display；而他兄弟约翰·诺尔这时在导演乔治·卢卡斯的电影特殊效果制作公司Industry Light Magic工作，对Thomas的程序很感兴趣。两兄弟在此后的一年多把Display不断修改为功能更为强大的图像编辑程序，经过多次改名后，在一个展会上接受了一个参展观众的建议，把程序改名为Photoshop。此时的Display/Photoshop已经有Level、色彩平衡、饱和度等调整。此外John写了一些程序，后来成为插件（Plug-in）的基础。
               </p>
             </div>
          </div>
        </div>


        <div class="container-fluid">
        <div class="col-lg-11  features-info-right text-center" style="background-image: url('img/browser.png');">
          <div class="col-lg-6  col-lg-offset-1  col-md-7  col-md-offset-1 col-xs-7 col-xs-offset-1">
            <h2 style="">
              HTML
            </h2>
            <p style="color: #aaaaaa">
              超级文本标记语言是标准通用标记语言下的一个应用，也是一种规范，一种标准，
              超文本标记语言
              超文本标记语言 (15张)
              它通过标记符号来标记要显示的网页中的各个部分。网页文件本身是一种文本文件，通过在文本文件中添加标记符，可以告诉浏览器如何显示其中的内容（如：文字如何处理，画面如何安排，图片如何显示等）。浏览器按顺序阅读网页文件，然后根据标记符解释和显示其标记的内容，对书写出错的标记将不指出其错误，且不停止其解释执行过程，编制者只能通过显示效果来分析出错原因和出错部位。但需要注意的是，对于不同的浏览器，对同一标记符可能会有不完全相同的解释，因而可能会有不同的显示效果。
            </p>
          </div>


        </div>
        </div>


        <div class="container-fluid" style="background-color: #ebebeb;">
        <div class="col-lg-11 col-lg-offset-1 features-info-left text-center" style="background-image: url('img/wb.png');">
          <div class="col-lg-6  col-lg-offset-5 col-md-7  col-md-offset-4 col-xs-7 col-xs-offset-4">
            <h2 style="color:#aaaaaa">
              JavaScript
            </h2>
            <p style="color: #aaaaaa">
              JavaScript一种直译式脚本语言，是一种动态类型、弱类型、基于原型的语言，内置支持类型。它的解释器被称为JavaScript引擎，为浏览器的一部分，广泛用于客户端的脚本语言，最早是在HTML（标准通用标记语言下的一个应用）网页上使用，用来给HTML网页增加动态功能。
              在1995年时，由Netscape公司的Brendan Eich，在网景导航者浏览器上首次设计实现而成。因为Netscape与Sun合作，Netscape管理层希望它外观看起来像Java，因此取名为JavaScript。但实际上它的语法风格与Self及Scheme较为接近。[1]
              为了取得技术优势，微软推出了JScript，CEnvi推出ScriptEase，与JavaScript同样可在浏览器上运行。为了统一规格，因为JavaScript兼容于ECMA标准，因此也称为ECMAScript。

            </p>
          </div>
        </div>
        </div>

        <div class="container-fluid">
        <div class="col-lg-11  features-info-right text-center " style="background-image: url('img/dw.png');">
          <div class="col-lg-6  col-lg-offset-1  col-md-7  col-md-offset-1 col-xs-7 col-xs-offset-1">
            <h2 style="color:#aaaaaa">
              DW
            </h2>
            <p style="color: #aaaaaa">
              Adobe Dreamweaver，简称“DW”，中文名称 "梦想编织者"，是美国MACROMEDIA公司开发的集网页制作和管理网站于一身的所见即所得网页编辑器，DW是第一套针对专业网页设计师特别发展的视觉化网页开发工具，利用它可以轻而易举地制作出跨越平台限制和跨越浏览器限制的充满动感的网页。[1]
              Macromedia公司成立于1992年，2005年被Adobe公司收购。
              Adobe Dreamweaver使用所见即所得的接口，亦有HTML（标准通用标记语言下的一个应用）编辑的功能。它有Mac和Windows系统的版本。随Macromedia被Adobe收购后，Adobe也开始计划开发Linux版本的Dreamweaver了。 Dreamweaver自MX版本开始，使用了Opera的排版引擎"Presto" 作为网页预览。            </p>
          </div>
        </div>
        </div>



      </div>

  </div>

  <div class="nav-xs">

  <nav class="navbar navbar-default navbar-fixed-bottom visible-xs  ">
  <div class="container text-center under-nav" >


    <div class="col-xs-3 under-nav-item" style="background-image: url('img/by.png');">
    <a href="#main">
      <p style="color: black"> 本页</p>
    </a>

    </div>
    <div class="col-xs-3 under-nav-item" style="background-image: url('img/allcourse.png')">

      <p>
        开始
      </p>
    </div>


    <div class="col-xs-3 under-nav-item" style="background-image: url('img/mycourse.png')">


      <p>
        我的
      </p>
    </div>
    <div class="col-xs-3 under-nav-item" style="background-image: url('img/app.png')">

       <p>app</p>
    </div>

    <style>



    </style>
    <script>



    </script>
  </div>
  </nav>
  </div>

</main>
@endsection



