import React from 'react';

import img1 from "/src/images/cloud.jpg";
import img2 from "/src/images/industry.jpg";
import img3 from "/src/images/balen.png";


import { useNavigate } from 'react-router-dom';

export const Home = () => {
    const navigate = useNavigate();
    return (
        <header>
            <nav>
                <section className="flex flex-col md:flex-row justify-center items-center space-x-8 p-6">
                    
                    <img src={img1} alt="images" className="w-[400px] h-[300px] rounded-2xl" />
                    
                    {/* </div> */}
                    <div className="p-6">
                        <span className="bg-black text-white text-xs font-semibold px-2 py-1 rounded">Breaking</span>
                        <h1 className='text-3xl font-bold mt-2' onClick={() => navigate('/paragraph')} style={{ cursor: 'pointer' }}>
                            Global Summit Addresses Climate <br /> Change with New Initiatives
                        </h1>
                        <p className="text-gray-500 text-base mt-2.5">
                            World leaders gather to announce
                            <br />
                            <span className="inline-block">ambitious carbon reduction targets</span>
                            <span> and funding for renewable energy projects <br /> in developing nations.</span>
                        </p>
                    </div>


                   
                   <div className="absolute left-0 -bottom-83 ml-8">
                   <img src={img2} alt="industry" className="w-[400px] h-[300px] rounded-2xl" />
    <div className="p-6 mt-12 absolute right-10">
        <div className='ml-auto mr-auto relative left-96 -top-80 bottom-52'>
            <div className='ml-[39px] '>

                <span className="bg-black text-white text-xs font-semibold px-2 py-1 rounded">Breaking</span>
                <h1 className='text-3xl font-bold mt-2' onClick={() => navigate('/paragraph')} style={{ cursor: 'pointer' }}>
                    Global Summit Addresses Climate Change with New Initiatives
                </h1>
               
            </div>
        </div>
    </div>

                   
</div>



<div className='absolute -right-24 -bottom-full   '>
<div className='relative -right 48 top-56 '>
        <div className="p-6 grid grid-cols-3 gap-6 relative bottom-11 flex-nowrap ">
          <div className="bg-gray-100 rounded-lg shadow-md p-4">
            <div className="h-40 bg-gray-300 flex items-center justify-center rounded-md">
                 <img src="" alt="images" className="w-[445px] h-[165px] rounded-2xl" />
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
               <img src="" alt="images" className="w-[445px] h-[165px] rounded-2xl" />
                </div>
            {/* <h2 className="mt-4 text-lg font-bold text-black">Supreme Court to Hear Landmark Privacy Case</h2> */}
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
          </div>


    

                    <aside className="w-full md:w-1/3 p-4 flex flex-col items-center text-center">
                        <h2 className="text-xl font-bold mb-4 mt-12">Latest News</h2>
                        <div className="space-y-4 text-left">
                            <div>
                                <h3 className="text-sm font-semibold text-gray-600">Technology</h3>
                                <a href="#" className="text-lg font-bold hover:underline">Tech Giant Unveils Revolutionary AI Assistant</a>
                                <p className="text-sm text-gray-500">2 hours ago</p>
                            </div>
                            <div>
                                <h3 className="text-sm font-semibold text-gray-600">Business</h3>
                                <p className="text-lg font-bold hover:underline cursor-pointer" onClick={() => navigate('/businesses')}>Stock Markets Reach Record Highs Amid Economic Recovery</p>
                                <p className="text-sm text-gray-500">4 hours ago</p>
                            </div>
                            <div>
                                <h3 className="text-sm font-semibold text-gray-600 ">Sports</h3>
                                <p className="text-lg font-bold hover:underline cursor-pointer" onClick={() => navigate('/sported')}>
                                    National Team Advances to Championship Finals
                                </p>
                                <p className="text-sm text-gray-500">6 hours ago</p>
                            </div>
                            <div>
                                <h3 className="text-sm font-semibold text-gray-600" onClick={() => navigate('/health')} style={{ cursor: 'pointer' }}>
                                    Health
                                </h3>
                                <a href="#" className="text-lg font-bold hover:underline">New Study Reveals Benefits of Mediterranean Diet</a>
                                <p className="text-sm text-gray-500">8 hours ago</p>
                            </div>
                        </div>
                        

                        <a href="#" className="text-blue-600 font-semibold mt-4">View All News →</a>
                        <div className="mt-6 space-y-4">
                            <div className="bg-gray-100 p-4 rounded-lg text-center relative">
                                <img src={img3} className="w-[400px] h-[300px] rounded-2xl" />
                                <p className="text-xs text-gray-500">Advertisement</p>
                                <div className="border border-dashed border-gray-400 p-4 text-sm text-gray-600">Ad Space - medium (top)</div>
                            </div> 
                        </div>






                    </aside>
                </section>
                <div className="flex flex-col items-center justify-center h-screen"></div>
             
            </nav>

            <section class=" bg-white">

</section>

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

        </header>
    );
};