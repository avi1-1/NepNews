// import React from 'react'

// export const Entertainment = () => {
//   return (
//      <header>  
//     <nav>
//   <div className="p-4 mt-20">
//     <a href="/" className="text-lg text-gray-600">&larr; Back to Home</a>
//   <  h1 className="text-4xl font-bold mt-2">Enternament</h1>
//     <p className="text-lg text-gray-500 mt-2">Latest news and updates from the sports category..</p>
//   </div>
  
//   <div className="flex flex-col items-center justify-center h-screen">
//         <p className="text-gray-500 text-lg text-center mb-4">No articles found in this category.</p>
//   <form className="flex justify-center">
//          <button className="bg-black text-white w-52 h-16 rounded-2xl">
//       Return to Homepage
//     </button>
//   </form>
  
//   </div>
  
  
//   <div className="flex justify-center items-center min-h-screen bg-gray-100">
//       <div className="w-full max-w-3xl bg-gray-50 p-8 rounded-lg shadow-md text-center">
//         <h2 className="text-2xl font-bold text-gray-900">Stay Updated</h2>
//         <p className="text-gray-600 mt-2">
//           Subscribe to our newsletter to receive the latest news and updates directly in your inbox.
//         </p>
//         <div className="mt-6 flex justify-center">
//           <div className="relative w-full max-w-md">
//             <span className="absolute inset-y-0 left-3 flex items-center text-gray-500">
//               📩
//             </span>
//             <input
//               type="email"
//               placeholder="Enter your email"
//               className="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-l-lg focus:ring focus:ring-gray-300 focus:outline-none"
//             />
//           </div>
//           <button className="bg-black text-white px-5 py-2 rounded-r-lg hover:bg-gray-800">
//             Subscribe
//           </button>
//         </div>
//       </div>
//     </div>
    
  
//     </nav>
//     <footer class="bg-gray-900 text-white py-16">
//     <div class="container mx-auto px-6">
//         <div class="grid md:grid-cols-4 gap-8 mb-12">
//             <div>
//                 <h2 class="text-2xl font-bold">NewsHub<span class="text-primary">Name</span></h2>
//                 <p class="text-gray-400 mt-2">Delivering accurate ,timely news from around the globe.</p>
//             </div>
//             <div>
//                 <h3 class="text-lg font-semibold mb-4 relative pb-2 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-8 after:h-1 after:bg-primary">Catoragy</h3>
//                 <ul class="space-y-2">
//                     <li><a href="/" class="text-gray-400 hover:text-primary transition">Home</a></li>
//                     <li><a href="/technology" class="text-gray-400 hover:text-primary transition">Technology</a></li>
//                     <li><a href="/business" class="text-gray-400 hover:text-primary transition">business</a></li>
//                     <li><a href="/Sports" class="text-gray-400 hover:text-primary transition">Sports</a></li>
//                     <li><a href="/Entertainment" class="text-gray-400 hover:text-primary transition">Entertainment</a></li>
//                     <li><a href="/Politics" class="text-gray-400 hover:text-primary transition">Politics"</a></li>

                   
//                 </ul>
//             </div>
//             <div>
//                 <h3 class="text-lg font-semibold mb-4 relative pb-2 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-8 after:h-1 after:bg-primary">Company</h3>
//                 <ul class="space-y-2">
//                     <li><a href="#" class="text-gray-400 hover:text-primary transition">About Us</a></li>
//                     <li><a href="#" class="text-gray-400 hover:text-primary transition">Careers</a></li>
//                     <li><a href="#" class="text-gray-400 hover:text-primary transition">Contact</a></li>
//                     <li><a href="#" class="text-gray-400 hover:text-primary transition">Advertise</a></li>
//                     <li><a href="#" class="text-gray-400 hover:text-primary transition">Ethics Policy</a></li>
//                     <li><a href="#" class="text-gray-400 hover:text-primary transition">SEO Optimization</a></li>
//                 </ul>
//             </div>
//             <div>
//                 <h3 class="text-lg font-semibold mb-4 relative pb-2 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-8 after:h-1 after:bg-primary">Newsletter</h3>
//                 <p class="text-gray-400 mb-4">Subscribe to our newsletter to receive updates and news.</p>
                
//             </div>
//         </div>
//         <div class="border-t border-gray-700 pt-6 flex flex-col md:flex-row justify-between items-center">
//             <div class="flex space-x-6 mb-4 md:mb-0">
//                 <a href="#" class="text-gray-400 hover:text-primary transition">Terms of service</a>
//                 <a href="#" class="text-gray-400 hover:text-primary transition">Privacy Policy</a>
//                 <a href="#" class="text-gray-400 hover:text-primary transition">Cookoe Pokicy</a>
//                 <a href="#" class="text-gray-400 hover:text-primary transition">GDPR</a>
//             </div>
//             <p class="text-gray-400 align-center">&copy; 2025 NewsHub. All Rights Reserved.</p>
//         </div>

//     </div>
// </footer>  

//   </header>
//   )
// }
import React from 'react';

export const Entertainment = () => {
  return (
    <>
      <header>
        <nav>
          <div className="p-4 mt-20">
            <a href="/" className="text-lg text-gray-600">&larr; Back to Home</a>
            <h1 className="text-4xl font-bold mt-2">Entertainment</h1>
            <p className="text-lg text-gray-500 mt-2">Latest news and updates from the sports category.</p>
          </div>
        </nav>
      </header>

      <main>
        <div className="flex flex-col items-center justify-center h-screen">
          <p className="text-gray-500 text-lg text-center mb-4">No articles found in this category.</p>
          <form className="flex justify-center">
            <button className="bg-black text-white w-52 h-16 rounded-2xl">
              Return to Homepage
            </button>
          </form>
        </div>

        <div className="flex justify-center items-center min-h-screen bg-gray-100">
          <div className="w-full max-w-3xl bg-gray-50 p-8 rounded-lg shadow-md text-center">
            <h2 className="text-2xl font-bold text-gray-900">Stay Updated</h2>
            <p className="text-gray-600 mt-2">
              Subscribe to our newsletter to receive the latest news and updates directly in your inbox.
            </p>
            <div className="mt-6 flex justify-center">
              <div className="relative w-full max-w-md">
                <span className="absolute inset-y-0 left-3 flex items-center text-gray-500">📩</span>
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
      </main>

      <footer className="bg-gray-900 text-white py-16">
        <div className="container mx-auto px-6">
          <div className="grid md:grid-cols-4 gap-8 mb-12">
            <div>
              <h2 className="text-2xl font-bold">
                NewsHub<span className="text-primary">Name</span>
              </h2>
              <p className="text-gray-400 mt-2">
                Delivering accurate, timely news from around the globe.
              </p>
            </div>

            <div>
              <h3 className="text-lg font-semibold mb-4 relative pb-2 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-8 after:h-1 after:bg-primary">
                Category
              </h3>
              <ul className="space-y-2">
                <li><a href="/" className="text-gray-400 hover:text-primary transition">Home</a></li>
                <li><a href="/technology" className="text-gray-400 hover:text-primary transition">Technology</a></li>
                <li><a href="/business" className="text-gray-400 hover:text-primary transition">Business</a></li>
                <li><a href="/sports" className="text-gray-400 hover:text-primary transition">Sports</a></li>
                <li><a href="/entertainment" className="text-gray-400 hover:text-primary transition">Entertainment</a></li>
                <li><a href="/politics" className="text-gray-400 hover:text-primary transition">Politics</a></li>
              </ul>
            </div>

            <div>
              <h3 className="text-lg font-semibold mb-4 relative pb-2 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-8 after:h-1 after:bg-primary">
                Company
              </h3>
              <ul className="space-y-2">
                <li><a href="#" className="text-gray-400 hover:text-primary transition">About Us</a></li>
                <li><a href="#" className="text-gray-400 hover:text-primary transition">Careers</a></li>
                <li><a href="#" className="text-gray-400 hover:text-primary transition">Contact</a></li>
                <li><a href="#" className="text-gray-400 hover:text-primary transition">Advertise</a></li>
                <li><a href="#" className="text-gray-400 hover:text-primary transition">Ethics Policy</a></li>
                <li><a href="#" className="text-gray-400 hover:text-primary transition">SEO Optimization</a></li>
              </ul>
            </div>

            <div>
              <h3 className="text-lg font-semibold mb-4 relative pb-2 after:content-[''] after:absolute after:bottom-0 after:left-0 after:w-8 after:h-1 after:bg-primary">
                Newsletter
              </h3>
              <p className="text-gray-400 mb-4">Subscribe to our newsletter to receive updates and news.</p>
            </div>
          </div>

          <div className="border-t border-gray-700 pt-6 flex flex-col md:flex-row justify-between items-center">
            <div className="flex space-x-6 mb-4 md:mb-0">
              <a href="#" className="text-gray-400 hover:text-primary transition">Terms of Service</a>
              <a href="#" className="text-gray-400 hover:text-primary transition">Privacy Policy</a>
              <a href="#" className="text-gray-400 hover:text-primary transition">Cookie Policy</a>
              <a href="#" className="text-gray-400 hover:text-primary transition">GDPR</a>
            </div>
            <p className="text-gray-400">&copy; 2025 NewsHub. All Rights Reserved.</p>
          </div>
        </div>
      </footer>
    </>
  );
};
