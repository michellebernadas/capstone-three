@extends('template')

@section('title', 'Home')
<div class="overlay"></div>
    <div class="image">

        {{-- <h1 class="text-center ml3">One Spirit. One Body. One God</h1> --}}
        <h1 class="ml15">
          <span class="word">One Spirit.</span>
          <span class="word">One Body.</span>
          <span class="word">One God</span>
        </h1>
        <h4 class="text-center ml3">focused on sharing God's love and who is Christ today</h4>
    </div>
<div class="overlay2"></div>
    <div class="welcome_image" >
        <div class="container" >
            <div class="text-center" >
                <h1 data-aos="fade-up">WELCOME!</h1>
                <h3 data-aos="fade-up-right">God, who said, “Let there be light in the darkness,” has made this light shine in our hearts so we could know the glory of God that is seen in the face of Jesus Christ. (2 Corinthians 4:6 )</h3>
                <h4 data-aos="fade-up-left">If you're in Christ, then meet some of the people you'll be spending time with in eternity today . Make kingdom relationships and become a member of Christian Fellowship Forum!</h4>
                @if(!Auth::user())
                    <a href="/register" class="btn btn-primary" data-aos="fade-left">JOIN US NOW</a>
                @endif
            </div>
        </div>
    </div>

<div class="container-fluid landing mt-5 mb-3">

    <h2 class="card-title text-center mt-5 mb-3" data-aos="zoom-in">WHO WE ARE</h2>
    <div class="row landing mx-auto">
        <div class="card card-body landing" data-aos="fade-up"
     data-aos-anchor-placement="bottom-bottom">

            <p class="card-text" data-aos="zoom-in-left">
                Christian Fellowship is a  online Christian community allowing Christians around the world to fellowship with each other. You can  start or participate in a Bible-based discussion here in the Christian Fellowship Forums, where members can also share with each other their own videos, pictures, or favorite Christian music.

                If you are a Christian and need encouragement and fellowship, we're here for you! If you are not a Christian but interested in knowing more about Jesus our Lord, you're also welcome! Want to know what the Bible says, and how you can apply it to your life? Join us!

                To make new Christian friends now around the world, click here to join Christian Chat.
            </p>
        </div>
    </div>

</div>

@section('content')
    

@endsection