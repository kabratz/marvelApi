@extends('layout.app')

<style>
    .grid-here {
        display: grid;
        grid-template-columns: 1fr 1fr 1fr 1fr;
    }

    .trim img {
        max-width: 100%;
    }

    .character {
        text-align: center;
        justify-self: center;
        text-align: -webkit-center;
    }

    .trim {
        max-height: 200px;
        max-width: 200px;
        overflow: hidden;
    }
    .swiper-slide{
      text-align: center;
      text-align: -webkit-center;
    }
    .swiper-wrapper{
      height: auto !important;
    }
    .see-all{
      text-align: right;
    }
    h1, h2{
      font-weight: bold !important;
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />

<script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>

@section('content')
    <div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:100px">


      @if ($characters)
        <h1>
            Characters
        </h1>
        <!-- Slider main container -->
        <div class="swiper">
          <!-- Additional required wrapper -->
          <div class="swiper-wrapper">
            <!-- Slides -->
            @foreach ($characters as $character)
            <div class="swiper-slide">
              
              <div class="trim">
                  <img src="{{ $character->image }}" alt="{{ $character->name }}">
              </div>
              <h3>{{ $character->name }}</h3>
            </div>
            @endforeach
            ...
          </div>

          <!-- If we need navigation buttons -->
          <div class="swiper-button-prev"></div>
          <div class="swiper-button-next"></div>
          
          <a href="characters" class="see-all"><h2>See All</h2></a>

          <!-- If we need scrollbar -->
          <div class="swiper-scrollbar"></div>
        </div>

      @endif
      <hr>
      @if ($stories)
        <h1>
            Stories
        </h1>
        <!-- Slider main container -->
        <div class="swiper">
          <!-- Additional required wrapper -->
          <div class="swiper-wrapper">
            <!-- Slides -->
            @foreach ($stories as $story)
            <div class="swiper-slide">
              
              <h3>{{ $story->title }}</h3>
            </div>
            @endforeach
            ...
          </div>

          <!-- If we need navigation buttons -->
          <div class="swiper-button-prev"></div>
          <div class="swiper-button-next"></div>
          
          <a href="stories" class="see-all"><h2>See All</h2></a>

          <!-- If we need scrollbar -->
          <div class="swiper-scrollbar"></div>
        </div>

      @endif

    </div>

    <script type="module">
      import Swiper from 'https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.esm.browser.min.js'
    
      const swiper = new Swiper('.swiper', {
        
          // Optional parameters
          direction: 'horizontal',
          loop: true,
          slidesPerView: 4,
          spaceBetween: 10,
          calculateHeight:true,

          // Navigation arrows
          navigation: {
            nextEl: '.swiper-button-next',
            prevEl: '.swiper-button-prev',
          },

          // And if we need scrollbar
          scrollbar: {
            el: '.swiper-scrollbar',
          },
          breakpoints: {
            320: {
              slidesPerView: 1,
            },
            480: {
              slidesPerView: 2,
            },
            640: {
              slidesPerView: 3,
            },
            1250: {
              slidesPerView: 4,
            }
          }
        });
    </script>
@endsection
