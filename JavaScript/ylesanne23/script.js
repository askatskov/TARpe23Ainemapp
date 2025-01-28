// Firebase'i seadistamine
import { initializeApp } from "https://www.gstatic.com/firebasejs/9.17.1/firebase-app.js";
import { getFirestore, collection, addDoc, getDocs, deleteDoc, doc } from "https://www.gstatic.com/firebasejs/9.17.1/firebase-firestore.js";

const firebaseConfig = {
    apiKey: "AIzaSyCsky27GbjdKAWLVLDpKXWFw-3R_7hbIuo",
    authDomain: "flowabob.firebaseapp.com",
    projectId: "flowabob",
    storageBucket: "flowabob.firebasestorage.app",
    messagingSenderId: "331408087974",
    appId: "1:331408087974:web:8f19f648b5918275c98d67",
    measurementId: "G-35M1WY4MD2"
};

// Firebase inits
const app = initializeApp(firebaseConfig);
const db = getFirestore(app);

// Kontrolli Firebase ühendust
window.app = app; // Teeb "app" globaalseks (testimiseks konsoolis)
console.log("Firebase app name:", app.name); // Peaks tagastama "[DEFAULT]"

// HTML elemendid
const ratingInput = document.getElementById("rating");
const commentInput = document.getElementById("comment");
const submitButton = document.getElementById("submitFeedback");
const adminPanel = document.getElementById("adminPanel");
const toggleAdminButton = document.getElementById("toggleAdmin");
const averageRatingElem = document.getElementById("averageRating");
const feedbackCountElem = document.getElementById("feedbackCount");
const feedbackList = document.getElementById("feedbackList");

// Tagasiside saatmine
submitButton.addEventListener("click", async () => {
    const rating = parseInt(ratingInput.value);
    const comment = commentInput.value.trim();

    if (rating >= 1 && rating <= 5 && comment) {
        await addDoc(collection(db, "feedback"), { rating, comment, createdAt: new Date() });
        alert("Tagasiside saadetud!");
        ratingInput.value = "";
        commentInput.value = "";
    } else {
        alert("Palun täida kõik väljad õigesti!");
    }
});

// Admin paneeli kuvamine
toggleAdminButton.addEventListener("click", async () => {
    adminPanel.style.display = adminPanel.style.display === "none" ? "block" : "none";
    if (adminPanel.style.display === "block") {
        const feedbackSnapshot = await getDocs(collection(db, "feedback"));
        const feedbackData = feedbackSnapshot.docs.map(doc => ({ id: doc.id, ...doc.data() }));

        // Statistika arvutamine
        const totalRatings = feedbackData.reduce((sum, fb) => sum + fb.rating, 0);
        const feedbackCount = feedbackData.length;
        const averageRating = feedbackCount > 0 ? (totalRatings / feedbackCount).toFixed(2) : 0;

        averageRatingElem.textContent = averageRating;
        feedbackCountElem.textContent = feedbackCount;

        // Kommentaaride kuvamine
        feedbackList.innerHTML = "";
        feedbackData.forEach(feedback => {
            const li = document.createElement("li");
            li.textContent = `${feedback.rating} tärni: ${feedback.comment}`;
            const deleteButton = document.createElement("button");
            deleteButton.textContent = "Kustuta";
            deleteButton.addEventListener("click", async () => {
                await deleteDoc(doc(db, "feedback", feedback.id));
                alert("Kommentaar kustutatud!");
                toggleAdminButton.click(); // Refresh admin panel
            });
            li.appendChild(deleteButton);
            feedbackList.appendChild(li);
        });
    }
});
