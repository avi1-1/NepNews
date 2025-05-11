import React from 'react';

const Admin = () => {
  return (
    <div className="flex justify-center items-center h-screen bg-gray-50">
      <div className="text-center p-6 bg-white rounded-lg shadow-lg">
        <h1 className="text-2xl font-semibold mb-4">Admin Login</h1>
        <p className="text-sm mb-4">To access the admin portal, click the link below:</p>
        <a 
          href="http://localhost/nepnews/admin_login.php" 
          target="_blank" 
          rel="noopener noreferrer"
          className="text-blue-500 hover:text-blue-700 font-semibold"
        >
          Go to Admin Login
        </a>
      </div>
    </div>
  );
};

export default Admin;
