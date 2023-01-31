// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
import { getMessaging, getToken } from "firebase/messaging";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
// For Firebase JS SDK v7.20.0 and later, measurementId is optional
const firebaseConfig = {
    apiKey: "AIzaSyCp8iJO5oxMfVpEivHDYmbB4s6rq0rB8jI",
    authDomain: "graduated-project-2e62e.firebaseapp.com",
    projectId: "graduated-project-2e62e",
    storageBucket: "graduated-project-2e62e.appspot.com",
    messagingSenderId: "305336469690",
    appId: "1:305336469690:web:cc5f085a406f997029da83",
    measurementId: "G-J231KGGK97"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);

// Get registration token. Initially this makes a network call, once retrieved
// subsequent calls to getToken will return from cache.
const messaging = getMessaging();
getToken(messaging, { vapidKey: 'BOSWh_o0a1vYmNL60iveUmibyFBOisoWisrHGN8098GkSpjsx6BLNIYcWTw_pJxOLsFfksztOWtOeRzc6s6XN9o' }).then((currentToken) => {
    if (currentToken) {
        // Send the token to your server and update the UI if necessary
        console.log(currentToken);
    } else {
        // Show permission request UI
        console.log('No registration token available. Request permission to generate one.');
        // ...
    }
}).catch((err) => {
    console.log('An error occurred while retrieving token. ', err);
    // ...
});
