import { useState } from 'react';
import './App.css';
import './index.css';

import { BrowserRouter as Router, Routes, Route } from "react-router-dom";

import { Navbar } from "./components/Navbar";
import { Home } from "./pages/Home";
import { Sports } from "./pages/Sports";
import Technology from "./pages/Technology";
import Politics from "./pages/Politics";
import { Entertainment } from "./pages/Entertainment";
import { Business } from "./pages/Business";
import Paragraph from "./components/Paragraph/Paragraph";
import Health from "./components/Health/Health";  
import Sported from "./components/Sported/Sported";
import Businesses from "./components/Business/Businesses";
import Foreign from "./components/Politicalimg1/Foreign";
import Local from "./components/Localelection/Local"; 
import Budget from "./components/Budget/Budget"; 
import Constitutional from "./components/Constitutional/Constitutional"; 
import Supreme from "./components/Supreme/Supreme"; 
import Quantum from "./components/Quantum/Quantum"; 
import Phone from "./components/Phone/phone";
import Major from "./components/Major/Major";
import Virtual from "./components/Virtual/virtual";
import Ai from "./components/Ai/Ai";
import Staff from "./components/Staff/Staff";  // Staff login component
import Admin from "./components/Admin/Admin";  // Admin login component

function App() {
  return (
    <Router>
      <Navbar />
      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/sports" element={<Sports />} />
        <Route path="/technology" element={<Technology />} />
        <Route path="/politics" element={<Politics />} />
        <Route path="/entertainment" element={<Entertainment />} />
        <Route path="/business" element={<Business />} />
        <Route path="/paragraph" element={<Paragraph />} />
        <Route path="/health" element={<Health />} /> 
        <Route path="/sported" element={<Sported />} /> 
        <Route path="/businesses" element={<Businesses />} />
        <Route path="/foreign" element={<Foreign />} />
        <Route path="/local" element={<Local />} />
        <Route path="/budget" element={<Budget />} />
        <Route path="/constitutional" element={<Constitutional />} />
        <Route path="/supreme" element={<Supreme />} />
        <Route path="/quantum" element={<Quantum />} />
        <Route path="/phone" element={<Phone />} />
        <Route path="/major" element={<Major />} />
        <Route path="/virtual" element={<Virtual />} />
        <Route path="/ai" element={<Ai />} />
        <Route path="/staff" element={<Staff />} />
        <Route path="/Admin" element={<Admin />} /> {/* Admin login route */}
      </Routes>
    </Router>
  );
}

export default App;
