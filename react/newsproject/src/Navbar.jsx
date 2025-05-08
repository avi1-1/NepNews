// import React, { useState } from "react";
// import { FaUser } from "react-icons/fa";
// import { Link, useNavigate } from "react-router-dom";

// const categories = [
//   { name: "Sports", path: "/sports" },
//   { name: "Technology", path: "/technology" },
//   { name: "Politics", path: "/politics" },
//   { name: "Entertainment", path: "/entertainment" },
//   { name: "Business", path: "/business" },
// ];

// const Navbar = () => {
//   const [query, setQuery] = useState("");
//   const [showSuggestions, setShowSuggestions] = useState(false);
//   const navigate = useNavigate();

//   const filteredSuggestions = categories.filter((cat) =>
//     cat.name.toLowerCase().includes(query.toLowerCase())
//   );

//   const handleSelect = (path) => {
//     navigate(path);
//     setQuery("");
//     setShowSuggestions(false);
//   };

//   return (
//     <header className="fixed top-0 w-full z-[1000] bg-white shadow p-4 flex items-center justify-between">
//       <ul className="flex items-center space-x-6 text-gray-600">
//         <h1 className="font-bold text-2xl text-emerald-400">NepNews</h1>
//         {categories.map((cat) => (
//           <li key={cat.path}>
//             <Link to={cat.path} className="hover:text-emerald-400">
//               {cat.name}
//             </Link>
//           </li>
//         ))}
//       </ul>

//       {/* Login icon placeholder */}
//       <div className="relative">
//         <div className="border px-4 py-2 rounded-lg text-black hover:bg-cyan-400 cursor-pointer">
//           <FaUser />
//         </div>
//       </div>

//       {/* Search Input */}
//       <div className="relative ml-auto">
//         <input
//           type="text"
//           className="w-full max-w-xs border border-slate-200 rounded-md pl-3 pr-28 py-2 text-sm"
//           placeholder="Search news..."
//           value={query}
//           onChange={(e) => {
//             setQuery(e.target.value);
//             setShowSuggestions(true);
//           }}
//           onFocus={() => setShowSuggestions(true)}
//         />
//         {showSuggestions && query && (
//           <ul className="absolute mt-1 w-full bg-white border border-gray-300 rounded shadow z-50">
//             {filteredSuggestions.length > 0 ? (
//               filteredSuggestions.map((cat) => (
//                 <li
//                   key={cat.name}
//                   className="px-4 py-2 hover:bg-emerald-100 cursor-pointer"
//                   onClick={() => handleSelect(cat.path)}
//                 >
//                   {cat.name}
//                 </li>
//               ))
//             ) : (
//               <li className="px-4 py-2 text-gray-400">No results found</li>
//             )}
//           </ul>
//         )}
//       </div>
//     </header>
//   );
// };

// export default Navbar;
