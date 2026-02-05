document.addEventListener('DOMContentLoaded', () => {
    const panels = document.querySelectorAll('.accordion-panel');

    if (!panels.length) return;

    // Set first panel active by default
    panels[0].classList.add('active');

    panels.forEach(panel => {
        panel.addEventListener('click', () => {
            panels.forEach(p => p.classList.remove('active'));
            panel.classList.add('active');
        });
    });

    panel.addEventListener('click', () => {
    if (panel.classList.contains('active')) return;

    panels.forEach(p => p.classList.remove('active'));
    panel.classList.add('active');
});

});
