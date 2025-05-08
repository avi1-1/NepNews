
import React from 'react'
import img1 from "/src/images/cloud.jpg";
import img2 from "/src/images/technology.png";
import img3 from "/src/images/camera.png";
import img4 from "/src/images/cyber.png";
import img5 from "/src/images/vechicle.jpg";
import img6 from "/src/images/Virtual.png";
import img7 from "/src/images/Quantin.png";

import { useNavigate } from 'react-router-dom';




const Technology = () => {
  const navigate = useNavigate();
  return (
    <header>  
    <nav>
    <div>
      <section>
        <div className="p-4 mt-20">
          <a href="/" className="text-lg text-gray-600  ml-28">&larr; Back to Home</a>
          <h1 className="text-4xl font-bold mt-2 ml-28">Technology</h1>
          <p className="text-lg text-gray-500 mt-2 ml-28">
          Discover the latest innovations, tech industry news, and digital transformation trends.
          </p>
        </div>
      </section>

      <div className="flex">
        <img 
          src={img2} 
          alt=""
          className="w-[60%] min-h-[70vh] bg-gray-100 p-4 ml-28 mt-16 rounded-2xl"
        />
        
        <div className="w-1/4 flex flex-col gap-4 ml-10 mt-32">
          <div className="bg-gray-100 p-4 rounded-lg shadow-md h-[250px] flex items-center justify-center relative">
            <span className="text-gray-400">Ad Space - large (middle)</span>
            <button className="absolute top-2 right-2 bg-gray-200 rounded-full p-1">✖</button>
          </div>
        </div>
      </div>
      <div className=''>
          {/* <h2 className='text-4xl font-bold  ml-28 mt-14'> 
          Tech Giant Unveils Revolutionary AI Assistant</h2> */}

<h1 className='text-4xl font-bold  ml-28 mt-14' onClick={() => navigate('/Ai')} style={{ cursor: 'pointer' }}>
New Healthcare Bill Passes with Bipartisan Support
                        </h1>
          <p className='text-lg text-gray-500  ml-28 mt-2  '>The comprehensive healthcare reform bill passed with support from both major parties after months of negotiation. </p>
          
        </div>
     
        <span className='mt-11'> <span className="text-gray-900 font-medium ml-16 mt-24"> By Alex Chen</span></span>
        <span>•</span>
        <span className="flex items-center">
          <svg className="w-4 h-4 text-gray-400 mr-1 ml-16 mt-" fill="none" stroke="currentColor" strokeWidth="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path strokeLinecap="round" strokeLinejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
          2 hours ago
        </span>
        <button className=" flex items-center hover:bg-gray-200 text-black font-semibold py-2 px-4 rounded-lg border border-gray-300 ml-16 mt-6">
        Read Full Story
        <svg className="w-4 h-4 ml-2" fill="none" stroke="currentColor" strokeWidth="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
          <path strokeLinecap="round" strokeLinejoin="round" d="M9 5l7 7-7 7"></path>
        </svg>
      </button>

      <section className='flex justify-center items-center min-h-screen bg-white relative -bottom-1 top-11'>
        <div className="p-6 grid grid-cols-3 gap-6 relative bottom-11 flex-nowrap">
          <div className="bg-gray-100 rounded-lg shadow-md p-4">
           
            <div className="h-40 bg-gray-300 flex items-center justify-center rounded-md">
          <img src={img7} alt="images" className="w-[445px] h-[165px] rounded-2xl" />
         </div>

            {/* <h2 className="mt-4 text-lg font-bold text-black">Quantum Computing Breakthrough Announced</h2> */}
            <h1 className='mt-4 text-lg font-bold text-black' onClick={() => navigate('/quantum')} style={{ cursor: 'pointer' }}>
            Quantum Computing Breakthrough Announced
                        </h1>
            <p className="text-gray-600 text-sm mt-2">Scientists achieve quantum supremacy with a processor solving problems beyond the capability of traditional supercomputers.</p>
            <p className="text-sm text-gray-500 mt-2">By <span className="font-medium text-gray-700">By Priya Sharma</span> • 5 hours ago</p>
          </div>

          <div className="bg-gray-100 rounded-lg shadow-md p-4">
            {/* <div className="h-40 bg-gray-300 flex items-center justify-center rounded-md">
              <span className="text-gray-500 overflow-hidden">Image</span>
            </div> */}
            <div className="h-40 bg-gray-300 flex items-center justify-center rounded-md">
          <img src={img3} alt="images" className="w-[445px] h-[165px] rounded-2xl" />
         </div>
            

            {/* <h2 className="mt-4 text-lg font-bold text-black">New Smartphone Features Advanced Camera Technology</h2> */}
            <h1 className='mt-4 text-lg font-bold text-black' onClick={() => navigate('/phone')} style={{ cursor: 'pointer' }}>
            New Smartphone Features Advanced Camera Technology
                        </h1>
            <p className="text-gray-600 text-sm mt-2">The latest flagship device introduces computational photography capabilities previously only available in professional equipment.</p>
            <p className="text-sm text-gray-500 mt-2 overflow-hidden">By <span className="font-medium text-gray-700 overflow-hidden">By Thomas Wright</span> • 1 day ago</p>
          </div>

          <div className="bg-gray-100 rounded-lg shadow-md p-4">
          <div className="h-40 bg-gray-300 flex items-center justify-center rounded-md">
          <img src={img4} alt="images" className="w-[445px] h-[165px] rounded-2xl" />
         </div>
            {/* <h2 className="mt-4 text-lg font-bold text-black">Major Cybersecurity Vulnerability Discovered</h2> */}

            <h2 className='mt-4 text-lg font-bold text-black' onClick={() => navigate('/major')} style={{ cursor: 'pointer' }}>
            Major Cybersecurity Vulnerability Discovered</h2>
            <p className="text-gray-600 text-sm mt-2">Security researchers identify a critical flaw affecting millions of devices worldwide..</p>
            <p className="text-sm text-gray-500 mt-2">By <span className="font-medium text-gray-700">Sophia Williams</span> • 1 day ago</p>
          </div> 
          
          </div>


      </section>
      
      <div className='flex justify-center items-center min-h-screen bg-white relative -bottom -1 -top-52'>
        <div className="p-6 grid grid-cols-3 gap-6 relative bottom-11 flex-nowrap">
          <div className="bg-gray-100 rounded-lg shadow-md p-4">
          <div className="h-40 bg-gray-300 flex items-center justify-center rounded-md">
          <img src={img5} alt="images" className="w-[445px] h-[165px] rounded-2xl" />
         </div>
            {/* <h2 className="mt-4 text-lg font-bold text-black">Electric Vehicle Startup Secures Record Funding</h2> */}

            <h2 className='mt-4 text-lg font-bold text-black' onClick={() => navigate('/major')} style={{ cursor: 'pointer' }}>
            Vehicle Startup Secures Record Funding</h2>
            <p className="text-gray-600 text-sm mt-2">The company's innovative battery technology attracts unprecedented investment from venture capital firms.</p>
            <p className="text-sm text-gray-500 mt-2">By <span className="font-medium text-gray-700">Jennifer Lee</span> • 5 hours ago</p>
          </div>

          <div className="bg-gray-100 rounded-lg shadow-md p-4">
          <div className="h-40 bg-gray-300 flex items-center justify-center rounded-md">
          <img src={img1} alt="images" className="w-[445px] h-[165px] rounded-2xl" />
         </div>
            <h2 className="mt-4 text-lg font-bold text-black">Local Elections Show Changing Voter Demographics</h2>
            <p className="text-gray-600 text-sm mt-2">Recent municipal elections reveal significant shifts in voting patterns across suburban districts.</p>
            <p className="text-sm text-gray-500 mt-2">By <span className="font-medium text-gray-700">David Chen</span> • 1 day ago</p>
          </div>

          <div className="bg-gray-100 rounded-lg shadow-md p-4">
          <div className="h-40 bg-gray-300 flex items-center justify-center rounded-md">
          <img src={img6} alt="images" className="w-[445px] h-[165px] rounded-2xl" />
         </div>
            {/* <h2 className="mt-4 text-lg font-bold text-black">Virtual Reality Platform Transforms Remote Work</h2> */}

            
            <h2 className='mt-4 text-lg font-bold text-black' onClick={() => navigate('/virtual')} style={{ cursor: 'pointer' }}>
            Virtual Reality Platform Transforms Remote Work</h2>

            <p className="text-gray-600 text-sm mt-2">New VR workspace solution aims to recreate office environments for distributed teams..</p>
            <p className="text-sm text-gray-500 mt-2">By <span className="font-medium text-gray-700">Sophia Williams</span> • 1 day ago</p>
          </div> 
          
          </div>
          </div>

<div className='flex justify-items-center justify-evenly relative -top-33'>
<div className="w-full max-w-3xl bg-gray-50 p-8 rounded-lg shadow-md text-center  ">
        <h2 className="text-2xl font-bold text-gray-900">Stay Updated</h2>
        <p className="text-gray-600 mt-2">
          Subscribe to our newsletter to receive the latest news and updates directly in your inbox.
        </p>
        <div className="mt-6 flex justify-center">
          <div className="relative w-full max-w-md">
            <span className="absolute inset-y-0 left-3 flex items-center text-gray-500">
              📩
            </span>
            <input
              type="email"
              placeholder="Enter your email"
              className="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-l-lg focus:ring focus:ring-gray-300 focus:outline-none"
            />
          </div>
          <button className="bg-black text-white px-5 py-2 rounded-r-lg hover:bg-gray-800">
            Subscribe
          </button>
        </div>
      </div>
    </div>

    </div>

   






    
    <footer class="bg-gray-900 text-white py-16">
    <div class="container mx-auto px-6">
        <div class="grid md:grid-cols-4 gap-8 mb-12">
            <div>
                <h2 class="text-2xl font-bold">NewsHub<span class="text-primary">Name</span></h2>
                <p class="text-gray-400 mt-2">Delivering accurate ,timely news from around the globe.</p>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4 relative pb-2 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-8 after:h-1 after:bg-primary">Catoragy</h3>
                <ul class="space-y-2">
                    <li><a href="#home" class="text-gray-400 hover:text-primary transition">Home</a></li>
                    <li><a href="#technology" class="text-gray-400 hover:text-primary transition">Technology</a></li>
                    <li><a href="#sport" class="text-gray-400 hover:text-primary transition">business</a></li>
                    <li><a href="#technology" class="text-gray-400 hover:text-primary transition">Sports</a></li>
                   
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4 relative pb-2 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-8 after:h-1 after:bg-primary">Company</h3>
                <ul class="space-y-2">
                    <li><a href="#" class="text-gray-400 hover:text-primary transition">About Us</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-primary transition">Careers</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-primary transition">Contact</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-primary transition">Advertise</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-primary transition">Ethics Policy</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-primary transition">SEO Optimization</a></li>
                </ul>
            </div>
            <div>
                <h3 class="text-lg font-semibold mb-4 relative pb-2 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-8 after:h-1 after:bg-primary">Newsletter</h3>
                <p class="text-gray-400 mb-4">Subscribe to our newsletter to receive updates and news.</p>
                
            </div>
        </div>
        <div class="border-t border-gray-700 pt-6 flex flex-col md:flex-row justify-between items-center">
            <div class="flex space-x-6 mb-4 md:mb-0">
                <a href="#" class="text-gray-400 hover:text-primary transition">Terms of service</a>
                <a href="#" class="text-gray-400 hover:text-primary transition">Privacy Policy</a>
                <a href="#" class="text-gray-400 hover:text-primary transition">Cookoe Pokicy</a>
                <a href="#" class="text-gray-400 hover:text-primary transition">GDPR</a>
            </div>
            <p class="text-gray-400 align-center">&copy; 2025 NewsHub. All Rights Reserved.</p>
        </div>

    </div>
</footer>  

    </nav>
  </header>
  )
}

export default Technology
