

// import React, { useState } from "react";
// import { Link, useNavigate} from "react-router-dom";
// import { FaUser } from 'react-icons/fa';


// const LoginPopup = ({ onClose }) => (
//   // const navigate = useNavigate();
//   <div className="absolute right-0 top-10 w-72 bg-gray-800 text-white p-4 rounded-xl shadow-lg z-50">
// <button
//   className="font-semibold text-sm mb-1"
//   onClick={() => navigate('/staff')}
//   style={{ cursor: 'pointer' }}
// >
//   Staff login
// </button>

//     <p className="text-xs mb-4 text-gray-300"></p>
//     <hr className="border-gray-600 mb-3 border-2 border-b-white" />
//     <p className="text-sm font-medium mb-2"> Admin login</p>
//     <button onClick={onClose} className="mt-2 text-sm text-red-400 hover:text-red-300">Close</button>
//   </div>
// );

// export const Navbar = () => {
  

  
//   const [query, setQuery] = useState("");
//   const [showLoginPopup, setShowLoginPopup] = useState(false);

//   const handleSearch = (e) => {
//     e.preventDefault();
//     if (query.trim() !== "") {
//       console.log("Searching for:", query);
//       setQuery("");
//     } else {
//       alert("Please enter a search term.");
//     }
//   };

//   const handleKeyDown = (e) => {
//     if (e.key === "Enter") {
//       handleSearch(e);
//     }
//   };

//   return (
//     <header className="fixed top-0 w-full z-[1000] bg-white shadow p-4 transition-all flex items-center justify-between">
//       {/* Left Side Links */}
//       <ul className="flex justify-center items-center space-x-6 text-gray-600">
//         <h1 className="font-bold text-2xl text-emerald-400">NepNews</h1>
//         <li><Link to="/" className="hover:text-black">Home</Link></li>
//         <li><Link to="/sports" className="hover:text-emerald-400">Sports</Link></li>
//         <li><Link to="/technology" className="hover:text-emerald-400">Technology</Link></li>
//         <li><Link to="/politics" className="hover:text-emerald-400">Politics</Link></li>
//         <li><Link to="/entertainment" className="hover:text-black">Entertainment</Link></li>
//         <li><Link to="/business" className="hover:text-emerald-400">Business</Link></li>
//       </ul>

//       {/* User Icon + Login Popup */}
//       <div className="relative -right-96 ml-96">
//         <div
//           className="border border-gray-300 px-4 py-2 rounded-lg text-black hover:bg-cyan-400 cursor-pointer"
//           onClick={() => setShowLoginPopup(!showLoginPopup)}
//         >
//           <FaUser />
//         </div>
//         {showLoginPopup && <LoginPopup onClose={() => setShowLoginPopup(false)} />}
//       </div>

//       {/* Search Input */}
//       <div className="relative -left-48 ml-auto">
//         <form onSubmit={handleSearch}>
//           <input
//             className="w-full max-w-xs bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md pl-3 pr-28 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow ml-2"
//             placeholder="Search news..."
//             value={query}
//             onChange={(e) => setQuery(e.target.value)}
//             onKeyDown={handleKeyDown}
//             onClick={() => setQuery("")}
//           />
//           <button
//             className="absolute top-1 right-1 flex items-center rounded bg-slate-800 py-1 px-2.5 border border-transparent text-center text-sm text-white transition-all shadow-sm hover:shadow"
//             type="submit"
//           >
//             <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" className="w-4 h-4 mr-2" viewBox="0 0 24 24">
//               <path fillRule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z" clipRule="evenodd" />
//             </svg>
//             Search
//           </button>
//         </form>
//       </div>
//     </header>
//   );
// };


import React, { useState } from "react";
import { Link, useNavigate } from "react-router-dom";
import { FaUser } from 'react-icons/fa';

const LoginPopup = ({ onClose }) => {
  const navigate = useNavigate();

  return (
    <div className="absolute right-0 top-10 w-72 bg-gray-800 text-white p-4 rounded-xl shadow-lg z-50">
      <button
        className="font-semibold text-sm mb-1"
        onClick={() => navigate('/staff')}
        style={{ cursor: 'pointer' }}
      >
        Staff login
      </button>

      <p className="text-xs mb-4 text-gray-300"></p>
      <hr className="border-gray-600 mb-3 border-2 border-b-white" />
      <button
  className="text-sm font-medium mb-2"
  onClick={() => navigate('/admin')}
>
  Admin login
</button>
<br></br>

      {/* <p className="text-sm font-medium mb-2"> Admin login</p> */}
      <button onClick={onClose} className="mt-2 text-sm text-red-400 hover:text-red-300">
        Close
      </button>
    </div>
  );
};

export const Navbar = () => {
  const [query, setQuery] = useState("");
  const [showLoginPopup, setShowLoginPopup] = useState(false);

  const handleSearch = (e) => {
    e.preventDefault();
    if (query.trim() !== "") {
      console.log("Searching for:", query);
      setQuery("");
    } else {
      alert("Please enter a search term.");
    }
  };

  const handleKeyDown = (e) => {
    if (e.key === "Enter") {
      handleSearch(e);
    }
  };

  return (
    <header className="fixed top-0 w-full z-[1000] bg-white shadow p-4 transition-all flex items-center justify-between">
      {/* Left Side Links */}
      <ul className="flex justify-center items-center space-x-6 text-gray-600">
        <h1 className="font-bold text-2xl text-emerald-400">NepNews</h1>
        <li><Link to="/" className="hover:text-black">Home</Link></li>
        <li><Link to="/sports" className="hover:text-emerald-400">Sports</Link></li>
        <li><Link to="/technology" className="hover:text-emerald-400">Technology</Link></li>
        <li><Link to="/politics" className="hover:text-emerald-400">Politics</Link></li>
        <li><Link to="/entertainment" className="hover:text-black">Entertainment</Link></li>
        <li><Link to="/business" className="hover:text-emerald-400">Business</Link></li>
      </ul>

      {/* User Icon + Login Popup */}
      <div className="relative -right-96 ml-96">
        <div
          className="border border-gray-300 px-4 py-2 rounded-lg text-black hover:bg-cyan-400 cursor-pointer"
          onClick={() => setShowLoginPopup(!showLoginPopup)}
        >
          <FaUser />
        </div>
        {showLoginPopup && <LoginPopup onClose={() => setShowLoginPopup(false)} />}
      </div>

      {/* Search Input */}
      <div className="relative -left-48 ml-auto">
        <form onSubmit={handleSearch}>
          <input
            className="w-full max-w-xs bg-transparent placeholder:text-slate-400 text-slate-700 text-sm border border-slate-200 rounded-md pl-3 pr-28 py-2 transition duration-300 ease focus:outline-none focus:border-slate-400 hover:border-slate-300 shadow-sm focus:shadow ml-2"
            placeholder="Search news..."
            value={query}
            onChange={(e) => setQuery(e.target.value)}
            onKeyDown={handleKeyDown}
            onClick={() => setQuery("")}
          />
          <button
            className="absolute top-1 right-1 flex items-center rounded bg-slate-800 py-1 px-2.5 border border-transparent text-center text-sm text-white transition-all shadow-sm hover:shadow"
            type="submit"
          >
            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" className="w-4 h-4 mr-2" viewBox="0 0 24 24">
              <path fillRule="evenodd" d="M10.5 3.75a6.75 6.75 0 1 0 0 13.5 6.75 6.75 0 0 0 0-13.5ZM2.25 10.5a8.25 8.25 0 1 1 14.59 5.28l4.69 4.69a.75.75 0 1 1-1.06 1.06l-4.69-4.69A8.25 8.25 0 0 1 2.25 10.5Z" clipRule="evenodd" />
            </svg>
            Search
          </button>
        </form>
      </div>
    </header>
  );
};
