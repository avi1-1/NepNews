
import React from 'react'
import img1 from "/src/images/foreign.png";
import img2 from "/src/images/election.png";
import img3 from "/src/images/budget.png";
import img4 from "/src/images/consition.png";
import img5 from "/src/images/supreme.png";
import img6 from "/src/images/health.png";


import { useNavigate } from 'react-router-dom';

const Politics = () => {
const navigate = useNavigate();
  return (
    <header>  
    <nav>
    <div>
      <section>
        <div className="p-4 mt-20">
          <a href="/" className="text-lg text-gray-600  ml-28">&larr; Back to Home</a>
          <h1 className="text-4xl font-bold mt-2 ml-28">Politics</h1>
          <p className="text-lg text-gray-500 mt-2 ml-28">
            Stay informed with the latest political news, policy updates, and government affairs...
          </p>
        </div>
      </section>

      <div className="flex">
        <img 
          src={img6} 
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
          
          {/* New Healthcare Bill Passes with Bipartisan Support</h2> */}
          <h2 className='text-4xl font-bold  ml-28 mt-14' onClick={() => navigate('/Ai')} style={{ cursor: 'pointer' }}>
New Healthcare Bill Passes with Bipartisan Support
                        </h2>
          <p className='text-lg text-gray-500  ml-28 mt-2  '>The comprehensive healthcare reform bill passed with support from both major parties after months of negotiation. </p>
          
        </div>
     
        <span className='mt-11'> <span className="text-gray-900 font-medium ml-16 mt-24"> by Michael Roberts</span></span>
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
                   <img src={img1} alt="images" className="w-[445px] h-[165px] rounded-2xl" />
                </div>
            {/* <h2 className="mt-4 text-lg font-bold text-black">Foreign Policy Shift Announced in Major Address</h2> */}
            <h1 className='mt-4 text-lg font-bold text-black' onClick={() => navigate('/foreign')} style={{ cursor: 'pointer' }}>
            Foreign Policy Shift Announced in Major Address
                        </h1>
            <p className="text-gray-600 text-sm mt-2">The administration outlined a new approach to international relations focusing on multilateral cooperation.</p>
            <p className="text-sm text-gray-500 mt-2">By <span className="font-medium text-gray-700">Jennifer Lee</span> • 5 hours ago</p>
          </div>

          <div className="bg-gray-100 rounded-lg shadow-md p-4">
            <div className="h-40 bg-gray-300 flex items-center justify-center rounded-md">
                      <img src={img2} alt="images" className="w-[445px] h-[165px] rounded-2xl" />
                     </div>
            {/* <h2 className="mt-4 text-lg font-bold text-black">Local Elections Show Changing Voter Demographics</h2> */}
            <h1 className='mt-4 text-lg font-bold text-black' onClick={() => navigate('/Local')} style={{ cursor: 'pointer' }}>
            Local Elections Show Changing Voter Demographics
                        </h1>
            <p className="text-gray-600 text-sm mt-2">Recent municipal elections reveal significant shifts in voting patterns across suburban districts.</p>
            <p className="text-sm text-gray-500 mt-2">By <span className="font-medium text-gray-700">David Chen</span> • 1 day ago</p>
          </div>

          <div className="bg-gray-100 rounded-lg shadow-md p-4">
            <div className="h-40 bg-gray-300 flex items-center justify-center rounded-md">
             <img src={img3} alt="images" className="w-[445px] h-[165px] rounded-2xl" />
               </div>
            {/* <h2 className="mt-4 text-lg font-bold text-black">Budget Negotiations Enter Final Phase</h2> */}
            <h1 className='mt-4 text-lg font-bold text-black' onClick={() => navigate('/budget')} style={{ cursor: 'pointer' }}>
            Budget Negotiations Enter Final Phase
                        </h1>
            <p className="text-gray-600 text-sm mt-2">Lawmakers are working to finalize the annual budget with key disagreements remaining on infrastructure spending.</p>
            <p className="text-sm text-gray-500 mt-2">By <span className="font-medium text-gray-700">Sophia Williams</span> • 1 day ago</p>
          </div> 
          
          </div>


      </section>
      <div className='flex justify-center items-center min-h-screen bg-white relative -bottom -1 -top-52'>
        <div className="p-6 grid grid-cols-3 gap-6 relative bottom-11 flex-nowrap">
          <div className="bg-gray-100 rounded-lg shadow-md p-4">
            <div className="h-40 bg-gray-300 flex items-center justify-center rounded-md">
                 <img src={img4} alt="images" className="w-[445px] h-[165px] rounded-2xl" />
                   </div>
            {/* <h2 className="mt-4 text-lg font-bold text-black">Constitutional Amendment Proposed for Electoral Reform</h2> */}
            <h1 className='mt-4 text-lg font-bold text-black' onClick={() => navigate('/Constitutional')} style={{ cursor: 'pointer' }}>
            Constitutional Amendment Proposed for Electoral Reform
                        </h1>
            <p className="text-gray-600 text-sm mt-2">A bipartisan group of senators introduced a proposal to modify the electoral college system.</p>
            <p className="text-sm text-gray-500 mt-2">By <span className="font-medium text-gray-700">Jennifer Lee</span> • 5 hours ago</p>
          </div>

          <div className="bg-gray-100 rounded-lg shadow-md p-4">
           <div className="h-40 bg-gray-300 flex items-center justify-center rounded-md">
               <img src={img5} alt="images" className="w-[445px] h-[165px] rounded-2xl" />
                </div>
           
            <h1 className='mt-4 text-lg font-bold text-black' onClick={() => navigate('/supreme')} style={{ cursor: 'pointer' }}>
            Supreme Court to Hear Landmark Privacy Case
                  </h1>
            <p className="text-gray-600 text-sm mt-2">The highest court will consider the boundaries of digital privacy in a case with far-reaching implications.</p>
            <p className="text-sm text-gray-500 mt-2">By <span className="font-medium text-gray-700">David Chen</span> • 1 day ago</p>
          </div>

          <div className="bg-gray-100 rounded-lg shadow-md p-4">
           <div className="h-40 bg-gray-300 flex items-center justify-center rounded-md">
                <img src="" alt="images" className="w-[445px] h-[165px] rounded-2xl" />
                 </div>
            <h2 className="mt-4 text-lg font-bold text-black">Budget Negotiations Enter Final Phase</h2>
            <p className="text-gray-600 text-sm mt-2">Lawmakers are working to finalize the annual budget with key disagreements remaining on infrastructure spending.</p>
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
                    <li><a href="/" class="text-gray-400 hover:text-primary transition">Home</a></li>
                    <li><a href="/technology" class="text-gray-400 hover:text-primary transition">Technology</a></li>
                    <li><a href="/business" class="text-gray-400 hover:text-primary transition">business</a></li>
                    <li><a href="/Sports" class="text-gray-400 hover:text-primary transition">Sports</a></li>
                    <li><a href="/Entertainment" class="text-gray-400 hover:text-primary transition">Entertainment</a></li>
                    <li><a href="/Politics" class="text-gray-400 hover:text-primary transition">Politics"</a></li>

                   
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

export default Politics
