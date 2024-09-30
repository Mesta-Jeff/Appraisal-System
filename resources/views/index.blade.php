<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>{{ env('APP_TITLE')}}</title>
  <base href="">
  <meta name="viewport" content="user-scalable=no, initial-scale=1, maximum-scale=1, minimum-scale=1, width=device-width, viewport-fit=cover">

  <link rel="shortcut icon" href="{{ asset('root/images/favicon.png')}}">
  <link id="home-table-link" rel="stylesheet" href="{{ asset ('root/lan/assets/splash.css')}}">
  <link id="home-table-link" rel="stylesheet" href="{{ asset ('root/lan/assets/theme.css')}}">
  <meta property="og:image" content="{{ asset('root/hyp/assets/images/favicon.ico')}}">
  <link rel="stylesheet" href="{{ asset('root/lan/styles.59d6eeba35a3b740.css')}}">


  <style ng-app-id="primeng">
    @layer primeng {

      p-inputnumber,
      .p-inputnumber {
        display: inline-flex;
      }

      .p-inputnumber-button {
        display: flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 auto;
      }

      .p-inputnumber-buttons-stacked .p-button.p-inputnumber-button .p-button-label,
      .p-inputnumber-buttons-horizontal .p-button.p-inputnumber-button .p-button-label {
        display: none;
      }

      .p-inputnumber-buttons-stacked .p-button.p-inputnumber-button-up {
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
        padding: 0;
      }

      .p-inputnumber-buttons-stacked .p-inputnumber-input {
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
      }

      .p-inputnumber-buttons-stacked .p-button.p-inputnumber-button-down {
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        border-bottom-left-radius: 0;
        padding: 0;
      }

      .p-inputnumber-buttons-stacked .p-inputnumber-button-group {
        display: flex;
        flex-direction: column;
      }

      .p-inputnumber-buttons-stacked .p-inputnumber-button-group .p-button.p-inputnumber-button {
        flex: 1 1 auto;
      }

      .p-inputnumber-buttons-horizontal .p-button.p-inputnumber-button-up {
        order: 3;
        border-top-left-radius: 0;
        border-bottom-left-radius: 0;
      }

      .p-inputnumber-buttons-horizontal .p-inputnumber-input {
        order: 2;
        border-radius: 0;
      }

      .p-inputnumber-buttons-horizontal .p-button.p-inputnumber-button-down {
        order: 1;
        border-top-right-radius: 0;
        border-bottom-right-radius: 0;
      }

      .p-inputnumber-buttons-vertical {
        flex-direction: column;
      }

      .p-inputnumber-buttons-vertical .p-button.p-inputnumber-button-up {
        order: 1;
        border-bottom-left-radius: 0;
        border-bottom-right-radius: 0;
        width: 100%;
      }

      .p-inputnumber-buttons-vertical .p-inputnumber-input {
        order: 2;
        border-radius: 0;
        text-align: center;
      }

      .p-inputnumber-buttons-vertical .p-button.p-inputnumber-button-down {
        order: 3;
        border-top-left-radius: 0;
        border-top-right-radius: 0;
        width: 100%;
      }

      .p-inputnumber-input {
        flex: 1 1 auto;
      }

      .p-fluid p-inputnumber,
      .p-fluid .p-inputnumber {
        width: 100%;
      }

      .p-fluid .p-inputnumber .p-inputnumber-input {
        width: 1%;
      }

      .p-fluid .p-inputnumber-buttons-vertical .p-inputnumber-input {
        width: 100%;
      }

      .p-inputnumber-clear-icon {
        position: absolute;
        top: 50%;
        margin-top: -0.5rem;
        cursor: pointer;
      }

      .p-inputnumber-clearable {
        position: relative;
      }
    }
  </style>
 
</head>

<body>
  <app-root ng-version="16.2.0" ng-server-context="ssr"><router-outlet></router-outlet>
    <landing class="ng-star-inserted">
      <div ng-reflect-ng-class="[object Object]" class="landing landing-light">
        <div class="landing-intro">
          <section class="landing-header px-5 lg:px-8" ng-reflect-ng-class="[object Object]">
            <div class="landing-header-container">
              <span>
                <a href="">
                  <img height="50" alt="PrimeNG" priority="" class="landing-header-logo"
                    src="{{ asset('root/images/logo-text-dark.png')}}">
                </a>
              </span>
            </div>
          </section>

          <section
            class="landing-hero flex align-items-center flex-column justify-content-center relative hero-animation"
            ng-reflect-ng-class="[object Object]">
            <div class="hero-inner z-2 relative">
              <div class="flex flex-column md:align-items-center md:flex-row">

                <div class="p-2 flex flex-row md:flex-column">
                  <a href="{{ route('student.questionaires')}}">
                    <div class="hero-box w-10rem h-10rem md:w-12rem md:h-12rem animation flex align-items-center justify-content-center">
                      <div class="flex flex-column align-items-center"><i class="pi pi-lock" style="font-size: 30px;"></i>
                        <div class="name"><b>I want to Appraise</b><span>click to login</span></div>
                      </div>
                    </div>
                  </a>
                  <a href="">
                    <div class="hero-box w-10rem h-10rem md:w-12rem md:h-12rem animation ml-4 md:ml-0 md:mt-4 flex align-items-center justify-content-center">
                      <div class="flex flex-column align-items-center"><i class="pi pi-book" style="font-size: 30px;"></i>
                        <div class="name"><b>Privacy Policy</b><span>Read More...</span></div>
                      </div>
                    </div>
                  </a>
                </div>

                <div class="p-2 flex flex-row md:flex-column">
                  <a href="{{ route('exams-number')}}">
                    <div
                      class="hero-box w-10rem h-10rem md:w-12rem md:h-12rem animation flex align-items-center justify-content-center">
                      <div class="flex flex-column align-items-center"><i class="pi pi-user" style="font-size: 30px;"></i>
                        <div class="name"><b>Examination No</b><span>get your seat no here</span></div>
                      </div>
                    </div>
                  </a>
                  <a href="{{ route('login')}}" id="come">
                    <div class="hero-box w-10rem h-10rem md:w-12rem md:h-12rem animation logo hidden md:flex my-4 align-items-center justify-content-center">
                      <div class="hero-box-inner text-center"><i class="pi pi-home" style="font-size: 30px;"></i>
                        <div class="name"><b class="font-bold">NES HOME</b><span>Visit site home</span></div>
                      </div>
                    </div>
                  </a>
                  <a href="{{ route('login')}}">
                    <div class="hero-box w-10rem h-10rem md:w-12rem md:h-12rem animation flex ml-4 md:ml-0 align-items-center justify-content-center">
                      <div class="flex flex-column align-items-center"><i class="pi pi-clock" style="font-size: 30px;"></i>
                        <div class="name"><b>Change Password</b><span>Check your days</span></div>
                      </div>
                    </div>
                  </a>
                </div>

                <div class="p-2 flex flex-row md:flex-column">
                  <a href="https://osissip.osis.online" target="_blank">
                    <div class="hero-box w-10rem h-10rem md:w-12rem md:h-12rem animation flex align-items-center justify-content-center">
                      <div class="flex flex-column align-items-center"><i class="pi pi-database" style="font-size: 30px;"></i>
                        <div class="name"><b>OSIS</b><span>Student Portal</span></div>
                      </div>
                    </div>
                  </a>
                  <a href="https://osissip.osis.online" target="_blank">
                    <div class="hero-box w-10rem h-10rem md:w-12rem md:h-12rem animation flex ml-4 md:ml-0 md:mt-4 align-items-center justify-content-center">
                      <div class="flex flex-column align-items-center"><i class="pi pi-database" style="font-size: 30px;"></i>
                        <div class="name"><b>OSIS</b><span>Staff Portal</span></div>
                      </div>
                    </div>
                  </a>
                </div>

              </div>
              <div class="hero-border-top hidden md:block"></div>
              <div class="hero-border-left hidden md:block"></div>
              <div class="hero-border-right hidden md:block"></div>
            </div>
            <section
              class="landing-getstarted flex flex-column md:flex-row align-items-center justify-content-center mt-8 z-1">
              <a class="linkbox active font-semibold py-3 px-4"> Electronic Appraisal System</a>
            </section>
          </section>

        </div>

        <section class="landing-footer pt-8 px-5 lg:px-8" style="margin-top: -120px;">
          <div class="landing-footer-container">
            <hr class="section-divider mt-2">
            <div class="flex flex-wrap justify-content-between py-6 gap-5">
              <a href="#">
                <img height="50" alt="PrimeNG" priority="" class="landing-header-logo" src="{{ asset('root/images/logo-text-dark.png')}}">
              </a>
            </div>
          </div>
        </section>
      </div>
    </landing>
  </app-root>

</body>

</html>
