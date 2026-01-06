<<<<<<< HEAD
<div class="services_section layout_padding">
    <div class="container">
        <h1 class="services_taital">Blogs</h1>
        <p class="services_text">
            Latest articles and updates
        </p>

        <div class="services_section_2">
            <div class="row">

                @forelse ($posts as $post)
                    <div class="col-md-4">
                        <div>
                            <img src="{{ asset($post->image ?? 'images/default.jpg') }}"
                                 class="services_img">
                        </div>

                        <h4>{{ $post->title }}</h4>

                        <p>
                            Post By <b>{{ $post->name }}</b>
                        </p>

                        <div class="btn_main">
                            <a href="{{ route('home.post_details', $post->id) }}">
                                Read More
                            </a>
                        </div>
                    </div>
                @empty
                    <p class="text-center w-100">
                        No blogs available.
                    </p>
                @endforelse

=======
 <div class="services_section layout_padding">
         <div class="container">
            <h1 class="services_taital">Blogs </h1>
            <p class="services_text">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration</p>
            <div class="services_section_2">
               <div class="row">
                  
                  @foreach ($posts as $post)
                    
                  <div class="col-md-4">
                     <div><img src="{{ asset($post->image) }}" class="services_img"></div>
                     <h4>{{ $post->title }}</h4>

                     <p>Post By <b>{{ $post->name }}</b> </p>
                     <div class="btn_main"><a href="{{ url('postDetails', $post->id) }}">Read More</a></div>
                  </div>
                   @endforeach
               </div>
>>>>>>> today-broken-backup
            </div>
        </div>
    </div>
</div>
