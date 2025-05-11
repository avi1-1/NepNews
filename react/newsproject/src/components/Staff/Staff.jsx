import React from 'react';

const Staff = () => {
  return (
    <div className="flex justify-center items-center h-screen bg-gray-50">
      <div className="text-center p-6 bg-white rounded-lg shadow-lg">
        <h1 className="text-2xl font-semibold mb-4">Hello, Staff!</h1>
        <p className="text-sm mb-4">Click the link below to login to the admin portal:</p>
        <a 
          href="http://localhost/nepnews/role-login.php" 
          target="_blank" 
          rel="noopener noreferrer"
          className="text-blue-500 hover:text-blue-700 font-semibold"
        >
          Staff Login 
        </a>
      </div>
    </div>
  );
};

export default Staff;
