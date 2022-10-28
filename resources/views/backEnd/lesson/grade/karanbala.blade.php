@extends('backEnd.layouts.master')
@section('master')
<body>
    <style>
        #hat {
            width: 50px;
            height: 50px;
            position: absolute;
            right: 0;
            top: 0;
            transform: translate(50%, -50%);
            z-index: 100;
        }

    </style>

        <!-- header -->
        <div class="header header-main mb-5">
            <div class="container-fluid border-bottom bg-header">
                <div class="row top-header">
                    <div class="col-3 top-header-item">
                        <a href="#" class="btn-header user-ico-box">
                            <i class="fa fa-user user-ico"></i>
                          
                          
                        </a>
                    </div>
                   
                    <div class="col-6 top-header-item d-flex justify-content-center">
                        <h2 class="brand-text ">
                            <span class="animate-charcter ">
                    
                                K@r@n B@L@
                            
                            </span>
                        </h2>
                    </div>
                    
                    <div class="col-3 top-header-item search">
                        <div class="search-box"> <input type="text" placeholder="کلمه مورد نظر را وارد کنید">
                            <a href="#" class="btn-header">
                                <i class="fa fa-search"></i>
                            </a></div>
                       
                        
                    </div>
                </div>
                <div class="row bottom-header">
                    <div class="col-3 text-left-news">
                        <span>خبر کران</span>
                    </div>
                   
                    <div class="empty col-6">
                        <marquee width="60%" behavior="scroll">{{ $grade->title }}</marquee>
                    </div>
                    <div class="date-time-box col-3">
                        14:20 - 2022 / 03 / 04
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 text-justify ">
                    <div class="row logo-box">
                        <div class="col-10 logo-text-box">
                            <h3>کران بالا</h3>
                            <p>کرانه ی موفقیت در کران بالا</p>
                        </div>
                        <div class="col-2 logo-img-box">
                            <img src="images/5.png" class="img-fluid logo-img">
                        </div>
                        
                    
                    </div>

                    <p>
                        {{ $grade->gradeDescription->description }}
                    </p>

                </div>

                <div class="col-lg-4"><img src="http://webfollower.net/learn/newopx/site/settings/217038633.png" class="img-fluid"></div>

            </div>

            <div class="container bg-light mt-5">
                <div class="row ">
                    <div class="col-lg-6 mirza-box"><img class="img-fluid p-3" style="border-radius:30px"
                            src="http://webfollower.net/learn/newopx/site/settings/915032575.jpeg">
                            <p class="unit">دهم ریاضی </p>
                    </div>
                    <div class="col-lg-6">

                        <p class="text-left">
                            مریم میرزاخانی
مریم میرزاخانی (۲۲ اردیبهشت ۱۳۵۶ – ۲۳ تیر ۱۳۹۶) ریاضی‌دان ایرانی و استاد دانشگاه استنفورد بود. میرزاخانی در سال ۲۰۱۴ به دلیل کنشگری در زمینه «دینامیک و هندسه سطوح ریمانی و فضاهای پیمانه‌ای آن‌ها» برنده مدال فیلدز شد که بالاترین جایزه در ریاضیات است. وی تنها زن[۴] و اولین ایرانی برندهٔ مدال فیلدز است.[۵] زمینهٔ تحقیقاتی او مشتمل بر نظریه تایشمولر، هندسه هذلولوی، نظریه ارگودیک و هندسه سیمپلکتیک بود. مریم میرزاخانی در دوران تحصیل در دبیرستان فرزانگان تهران، برندهٔ مدال طلای المپیاد جهانی ریاضی در سال‌های ۱۹۹۴ (هنگ‌کنگ) و ۱۹۹۵ (کانادا) شد و در این سال به‌عنوان نخستین دانش‌آموز ایرانی نمرهٔ کامل را به دست آورد.[۲] وی نخستین دانش آموز ایرانی بود که دو سال مدال طلا گرفت...]
                        </p>
                        <button type="button" class="btn btn-success float-right">ادامه مطلب</button>

                    </div>

                </div>
            </div>

        </div>
    



        <div class="viewed mt-5">
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div class="bbb_viewed_title_container">
                           
                            <!--        <div class="bbb_viewed_nav_container">
                                                              <div class="bbb_viewed_nav bbb_viewed_prev"><i class="fas fa-chevron-left"></i></div>
                                                              <div class="bbb_viewed_nav bbb_viewed_next"><i class="fas fa-chevron-right"></i></div>
                                                          </div> -->
                        </div>
                        <div class="bbb_viewed_slider_container" >
                            <div class="owl-carousel owl-theme bbb_viewed_slider">
                                <div class="owl-item">
                                    <div
                                        class="bbb_viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                        <div class="bbb_viewed_image">
                                           <a href="learn_index copy.html">
											    <img src="http://webfollower.net/learn-karanbala/images/learn.png" alt="">
										   </a>
                                        </div>
										<!--
                                        <div class="bbb_viewed_content text-center">
                                            <div class="bbb_viewed_price">متن تستی</div>
                                            <div class="bbb_viewed_name"><a href="#">متن تستی</a></div>
                                        </div>--->

                                    </div>

                                </div>
                                <div class="owl-item">
                                    <div
                                        class="bbb_viewed_item d-flex flex-column align-items-center justify-content-center text-center">
                                        <div class="bbb_viewed_image">
                                            <img src="http://webfollower.net/learn-karanbala/images/question.png" alt="">
												</div>
                                     

                                    </div>
                                </div>
                                <div class="owl-item">
                                    <div
                                        class="bbb_viewed_item d-flex flex-column align-items-center justify-content-center text-center">
                                        <div class="bbb_viewed_image">
                                            <img src="http://webfollower.net/learn-karanbala/images/exam.png" alt="">
												</div>

                                    </div>
                                </div>
                                <div class="owl-item">
                                    <div
                                        class="bbb_viewed_item is_new d-flex flex-column align-items-center justify-content-center text-center">
                                        <div class="bbb_viewed_image">
                                            <img src="http://webfollower.net/learn-karanbala/images/contactOnline.png" alt="">
												</div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


      


        <div class="container-fluid manual-main" >
            <div class="conatiner">
                <div class="row">
                    <div class="col-6">
                        <div class="d-flex flex-column intro-video">
                            <div class="intro-video-text">
                                <p>   
                                    دانش آموزان عزیر میتوانید در بخش 
                                    کتابچه راهنمای کران با تمام بخش های آموزش ,  آزمون و 
                                    ارتباط آنلاین و بانک سوالات بصورت متنی و اینفوگرافیک آشنا شوید
                                </p>
                                <p>
                                    برای دسترسی به ویدیو های معرفی هر بخش ,  روی 
                                    بخش مربوطه کلیک کنید .
                                </p>
                            </div>
                           
                            <div class="row manual-types">   
                                <div class="manual-type azmon i-hover">
                                    <span> آموزش</span>
                                   
                                </div>
                                <div class="manual-type class">
                                    <span> آزمون</span>
                                </div>
                                <div class="manual-type test">
                                    <span>بانک سوالات</span>                               
                                </div>
                                <div class="manual-type school"> 
                                    <span>ارتباط آنلاین</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 d-flex justify-content-center align-items-center manual-items">
                        <div class="manual">
                            <div class="manual-item-content i-amozesh">
                                <h3>
                                    کتابچه راهنما
                                    آموزش
                                </h3>
                                <p class="manual-img-box">
                                    <img src="images/5.png" class="img-fluid">
                                </p>
                            </div>
                            <div class="manual-item-content i-school">
                                <h3>
                                    کتابچه راهنما
                                    ارتباط آنلاین
                                </h3>
                                <p class="manual-img-box">
                                    <img src="images/1.jpeg" class="img-fluid">
                                </p>
                            </div>
                            <div class="manual-item-content i-class">
                                <h3>
                                    کتابچه راهنما
                                     آزمون
                                </h3>
                                <p class="manual-img-box">
                                    <img src="images/2.jpg" class="img-fluid">
                                </p>
                            </div>
                            <div class="manual-item-content i-test">
                                <h3>
                                    کتابچه راهنما
                                    بانک سوالات
                                </h3>
                                <p class="manual-img-box">
                                    <img src="images/3.jpg" class="img-fluid">
                                </p>
                            </div>
                        </div>

                   
                            
                        
                    </div>
                </div>
            </div>
          
        </div>  


       
     

        <div class="container-fluid my-2">
            <div class="row justify-content-center align-items-center">
                <div class="col-7 p-5 d-flex d-flex jus-end align-items-center student-img-box">
                    <img src="student.jpg" class="img-fluid" alt="">
                </div>
                <div class="col-3 d-flex jusctify-content-center align-items-center student-img-box">
                    <img src="race.png" class="img-fluid" alt="">
                </div>
                
            </div>
        </div>


    
     


          <div class="master mt-5">
            <div class="container">
                <h2>لیست اساتید</h2>
                <div class="row">
                    <div class="col">
                        <div class="bbb_master_title_container">
                           
                            <!--        <div class="bbb_viewed_nav_container">
                                                              <div class="bbb_viewed_nav bbb_viewed_prev"><i class="fas fa-chevron-left"></i></div>
                                                              <div class="bbb_viewed_nav bbb_viewed_next"><i class="fas fa-chevron-right"></i></div>
                                                          </div> -->
                        </div>
                        <div class="bbb_master_slider_container" >
                            <div class="owl-carousel owl-theme bbb_master_slider">
                                <div class="owl-item">
                                    <div class="bbb_master_item intro-master-content d-flex jusctify-content-center align-items-center flex-column">
                                        <div class="intro-master-img-box bbb_master_image d-flex jusctify-content-center align-items-center"><img src="images/1.jpeg" class="img-fluid master-img" alt=""></div>
                                        <h3 class="text-center">Master 1</h3>
                                        <p class="text-center">ایران</p>
                                        <p class="text-center text-info">***********</p>
                                        <p class="text-center">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Hic quae minus rerum, ut commodi assumenda debitis doloribus iste animi itaque explicabo nobis facilis voluptate molestiae, cum cumque! Dolorem quia debitis sunt dolorum hic! Adipisci, culpa iste et asperiores distinctio veniam repudiandae minima quisquam nam blanditiis nesciunt accusantium suscipit voluptates obcaecati!</p>
                                    </div>

                                </div>
                                <div class="owl-item">
                                    
                                    <div class="bbb_master_item intro-master-content d-flex jusctify-content-center align-items-center flex-column">
                                        <div class="intro-master-img-box bbb_master_image d-flex jusctify-content-center align-items-center"><img src="images/2.jpg" class="img-fluid master-img" alt=""></div>
                                        <h3 class="text-center">Master 1</h3>
                                        <p class="text-center">ایران</p>
                                        <p class="text-center text-info">***********</p>
                                        <p class="text-center">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Hic quae minus rerum, ut commodi assumenda debitis doloribus iste animi itaque explicabo nobis facilis voluptate molestiae, cum cumque! Dolorem quia debitis sunt dolorum hic! Adipisci, culpa iste et asperiores distinctio veniam repudiandae minima quisquam nam blanditiis nesciunt accusantium suscipit voluptates obcaecati!</p>
                                    </div>
                                </div>
                                <div class="owl-item">
                                    
                                    <div class="bbb_master_item intro-master-content d-flex jusctify-content-center align-items-center flex-column">
                                        <div class="intro-master-img-box bbb_master_image d-flex jusctify-content-center align-items-center"><img src="images/3.jpg" class="img-fluid master-img" alt=""></div>
                                        <h3 class="text-center">Master 1</h3>
                                        <p class="text-center">ایران</p>
                                        <p class="text-center text-info">***********</p>
                                        <p class="text-center">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Hic quae minus rerum, ut commodi assumenda debitis doloribus iste animi itaque explicabo nobis facilis voluptate molestiae, cum cumque! Dolorem quia debitis sunt dolorum hic! Adipisci, culpa iste et asperiores distinctio veniam repudiandae minima quisquam nam blanditiis nesciunt accusantium suscipit voluptates obcaecati!</p>
                                    </div>
                                </div>
                                <div class="owl-item">
                                    
                                    <div class="bbb_master_item intro-master-content d-flex jusctify-content-center align-items-center flex-column">
                                        <div class="intro-master-img-box bbb_master_image d-flex jusctify-content-center align-items-center"><img src="images/2.jpg" class="img-fluid master-img" alt=""></div>
                                        <h3 class="text-center">Master 1</h3>
                                        <p class="text-center">ایران</p>
                                        <p class="text-center text-info">***********</p>
                                        <p class="text-center">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Hic quae minus rerum, ut commodi assumenda debitis doloribus iste animi itaque explicabo nobis facilis voluptate molestiae, cum cumque! Dolorem quia debitis sunt dolorum hic! Adipisci, culpa iste et asperiores distinctio veniam repudiandae minima quisquam nam blanditiis nesciunt accusantium suscipit voluptates obcaecati!</p>
                                    </div>
                                </div>
                                <div class="owl-item">
                                    
                                    <div class="bbb_master_item intro-master-content d-flex jusctify-content-center align-items-center flex-column">
                                        <div class="intro-master-img-box bbb_master_image d-flex jusctify-content-center align-items-center"><img src="images/2.jpg" class="img-fluid master-img" alt=""></div>
                                        <h3 class="text-center">Master 1</h3>
                                        <p class="text-center">ایران</p>
                                        <p class="text-center text-info">***********</p>
                                        <p class="text-center">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Hic quae minus rerum, ut commodi assumenda debitis doloribus iste animi itaque explicabo nobis facilis voluptate molestiae, cum cumque! Dolorem quia debitis sunt dolorum hic! Adipisci, culpa iste et asperiores distinctio veniam repudiandae minima quisquam nam blanditiis nesciunt accusantium suscipit voluptates obcaecati!</p>
                                    </div>
                                </div>
                                <div class="owl-item">
                                    
                                    <div class="bbb_master_item intro-master-content d-flex jusctify-content-center align-items-center flex-column">
                                        <div class="intro-master-img-box bbb_master_image d-flex jusctify-content-center align-items-center"><img src="images/3.jpg" class="img-fluid master-img" alt=""></div>
                                        <h3 class="text-center">Master 1</h3>
                                        <p class="text-center">ایران</p>
                                        <p class="text-center text-info">***********</p>
                                        <p class="text-center">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Hic quae minus rerum, ut commodi assumenda debitis doloribus iste animi itaque explicabo nobis facilis voluptate molestiae, cum cumque! Dolorem quia debitis sunt dolorum hic! Adipisci, culpa iste et asperiores distinctio veniam repudiandae minima quisquam nam blanditiis nesciunt accusantium suscipit voluptates obcaecati!</p>
                                    </div>
                                </div>
                                <div class="owl-item">
                                    
                                    <div class="bbb_master_item intro-master-content d-flex jusctify-content-center align-items-center flex-column">
                                        <div class="intro-master-img-box bbb_master_image d-flex jusctify-content-center align-items-center"><img src="images/2.jpg" class="img-fluid master-img" alt=""></div>
                                        <h3 class="text-center">Master 1</h3>
                                        <p class="text-center">ایران</p>
                                        <p class="text-center text-info">***********</p>
                                        <p class="text-center">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Hic quae minus rerum, ut commodi assumenda debitis doloribus iste animi itaque explicabo nobis facilis voluptate molestiae, cum cumque! Dolorem quia debitis sunt dolorum hic! Adipisci, culpa iste et asperiores distinctio veniam repudiandae minima quisquam nam blanditiis nesciunt accusantium suscipit voluptates obcaecati!</p>
                                    </div>
                                </div>
                                <div class="owl-item">
                                    
                                    <div class="bbb_master_item intro-master-content d-flex jusctify-content-center align-items-center flex-column">
                                        <div class="intro-master-img-box bbb_master_image d-flex jusctify-content-center align-items-center"><img src="images/1.jpeg" class="img-fluid master-img" alt=""></div>
                                        <h3 class="text-center">Master 1</h3>
                                        <p class="text-center">ایران</p>
                                        <p class="text-center text-info">***********</p>
                                        <p class="text-center">Lorem ipsum dolor sit, amet consectetur adipisicing elit. Hic quae minus rerum, ut commodi assumenda debitis doloribus iste animi itaque explicabo nobis facilis voluptate molestiae, cum cumque! Dolorem quia debitis sunt dolorum hic! Adipisci, culpa iste et asperiores distinctio veniam repudiandae minima quisquam nam blanditiis nesciunt accusantium suscipit voluptates obcaecati!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
          
      
        <!-- Remove the container if you want to extend the Footer to full width. -->
<div class="container-fluid p-0">
    <!-- Footer -->
    <footer
            class="text-center text-lg-start text-dark rounded"
            style="background-color: #7187ff !important;"
            >
      <!-- Section: Social media -->
      <section
               class="d-flex justify-content-center text-white"
               style="background-color: #7187ff"
               >
        <!-- Left -->
        
        <!-- Left -->
  
        <!-- Right -->
        <div>
          <a href="" class="text-white me-4 btn-social">
            <i class="fa fa-telegram"></i>
          </a>
          <a href="" class="text-white me-4 btn-social">
            <i class="fa fa-instagram"></i>
          </a>

        </div>
        <!-- Right -->
      </section>
      <!-- Section: Social media -->
  
      <!-- Section: Links  -->
      <section class="">
        <div class="container text-center text-md-start">
          <!-- Grid row -->
          <div class="row mt-3">
            <!-- Grid column -->
            <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                <div class="e-namad-box">
                    <a href="#"><img src="images/enamad-logo.png" class="img-fluid" alt=""></a>
                    
                </div>
              
            </div>
            <!-- Grid column -->

  
  
            <!-- Grid column -->
            <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4 text-white">
              <!-- Links -->
              <h6 class="fw-bold text-left">تماس با ما</h6>
              <hr
                  class="mb-4 mt-0 d-inline-block mx-auto"
                  style="width: 250px; background-color: #7c4dff; height: 2px"
                  />
              <p class="text-left"><i class="fa fa-home mr-3"></i>استان تهران</p>
              <p class="text-left"><i class="fa fa-envelope mr-3"></i>karan@example.com</p>
              <p class="text-left" style="direction: revert;">+98 331231231
                <i class="fa fa-phone mr-3"></i>
              </p>
            </div>
            <!-- Grid column -->
          </div>
          <!-- Grid row -->
        </div>
      </section>
    </footer>
    <!-- Footer -->
  </div>
  <!-- End of .container -->
    @section('js')
  <script>
    $(document).ready(function(){
        $(".i-azmon").css('display' , "block");
        $(".i-school").css('display' , "none");
        $(".i-test").css('display' , "none");
        $(".i-class").css('display' , "none");
    
        $('.azmon').click(function(){
   
            $(".i-amozesh").css('display' , "block");
            $(".i-school").css('display' , "none");
            $(".i-test").css('display' , "none");
            $(".i-class").css('display' , "none");
            // add
            $(".azmon").addClass(' i-hover ');
            // remover
            $(".school").removeClass('i-hover');
            $(".test").removeClass('i-hover');
            $(".class").removeClass('i-hover');


            $('.school').css({           
                'transform' : 'translate(0px , 0px)'
              });

              $('.azmon').css({           
                'transform' : 'translate(0px , 0px)'
              });

              $('.test').css({           
                'transform' : 'translate(0px , 0px)'
              });

              $('.class').css({           
                'transform' : 'translate(0px , 0px)'
              });

            
        });

        $('.school').click(function(){

            $(".i-school").css('display' , "block");
            $(".i-amozesh").css('display' , "none");
            $(".i-test").css('display' , "none");
            $(".i-class").css('display' , "none");
            // add
            $(".school").addClass(' i-hover ');
            // remover
            $(".azmon").removeClass('i-hover');
            $(".test").removeClass('i-hover');
            $(".class").removeClass('i-hover');

            //$(".school").css('transform' , 'translate(-10px , 20px)');
      


            $('.school').css({           
                'transform' : 'translate(-10px , 20px)'
              });

              $('.azmon').css({           
                'transform' : 'translate(-10px , -20px)'
              });

              $('.test').css({           
                'transform' : 'translate(-10px , -20px)'
              });

              $('.class').css({           
                'transform' : 'translate(-10px , -20px)'
              });





        });

        $('.test').click(function(){
       
            $(".i-test").css('display' , "block");
            $(".i-school").css('display' , "none");
            $(".i-amozesh").css('display' , "none");
            $(".i-class").css('display' , "none");
            // add
            $(".test").addClass(' i-hover ');
            // remover
            $(".azmon").removeClass('i-hover');
            $(".school").removeClass('i-hover');
            $(".class").removeClass('i-hover');





            $('.school').css({           
                'transform' : 'translate(15px , -5px)'
              });

              $('.azmon').css({           
                'transform' : 'translate(15px , -10px)'
              });

              $('.test').css({           
                'transform' : 'translate(10px , 20px)'
              });

              $('.class').css({           
                'transform' : 'translate(10px , 20px)'
              });
        });

        $('.class').click(function(){
  
            $(".i-class").css('display' , "block");
            $(".i-school").css('display' , "none");
            $(".i-amozesh").css('display' , "none");
            $(".i-test").css('display' , "none");
             // add
             $(".class").addClass(' i-hover ');
             // remover
             $(".azmon").removeClass('i-hover');
             $(".school").removeClass('i-hover');
             $(".test").removeClass('i-hover');



             $('.school').css({           
                'transform' : 'translate(15px , -5px)'
              });

              $('.azmon').css({           
                'transform' : 'translate(15px , -10px)'
              });

              $('.test').css({           
                'transform' : 'translate(15px , 10px)'
              });

              $('.class').css({           
                'transform' : 'translate(10px , 30px)'
              });
        });
    });


  </script>
@endsection
