document.addEventListener('DOMContentLoaded', function() {
    const texts = [
        "Nourishing hearts, one meal at a time because kindness is the most satisfying dish.",
        "Fueling hope through food donations every plate makes a difference.",
        "Serving kindness, one meal donation at a time because a little generosity goes a long way.",
        "Kindness, plated and served each meal a testament, as said by the generosity we share.",
        "Give the gift of sustenance, donate with heart.",
        "Nourish a life, donate today.",
        "Every plate shared is a story of compassion.",
        "Share a meal, share the love.",
        "Food for the soul, donated with love."
    ];

    let index = 0;
    const changingText = document.getElementById('changing-text');

    setInterval(() => {
        changingText.style.animation = 'none'; // Clear the animation
        void changingText.offsetWidth; // Trigger reflow
        changingText.textContent = texts[index];
        changingText.style.animation = 'fadeInOut 5s forwards'; // Apply the animation
        index = (index + 1) % texts.length;
    }, 5000); // Change text every 5 seconds
});

