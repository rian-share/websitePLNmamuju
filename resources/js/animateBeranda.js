import { createTimeline, stagger, utils, splitText } from 'animejs';
import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";

const durasiBer = document.querySelector('.durasiAlert') ?? '';
if (durasiBer !== '') {
    setTimeout(async () => {
        await setTimeout(() => {
            durasiBer.classList.add('scale-50');
        }, 1000)
        durasiBer.classList.add('hidden')
    }, 10000)
    gsap.from(".home-tagline", {
        opacity: 0,
        y: 60,
        duration: 1.2,
        ease: "power3.out",
        delay: 0.2,
    });
}
// gambar hero zoom halus
gsap.from(".home-hero-img", {
    scale: 1.15,
    duration: 1.6,
    ease: "power2.out",
    delay: 0.1,
});



gsap.from(".home-map", {
    opacity: 0,
    y: 60,
    duration: 1,
    ease: "power2.out",
    scrollTrigger: {
        trigger: ".home-map",
        start: "top 85%",
        toggleActions: "play none none reverse",
    },
});



// judul terkini
gsap.from(".home-terkini > div:first-child", {
    opacity: 0,
    y: 40,
    duration: 0.9,
    ease: "power2.out",
    scrollTrigger: {
        trigger: ".home-terkini",
        start: "top 85%",
        toggleActions: "play none none reverse",
    },
});

// card berita (main + 2 kecil)
gsap.from([".terkini-main", ".terkini-card"], {
    opacity: 0,
    y: 70,
    duration: 1,
    ease: "power3.out",
    stagger: 0.2,
    scrollTrigger: {
        trigger: ".home-terkini",
        start: "top 80%",
        toggleActions: "play none none reverse",
    },
});

const { words, chars } = splitText('p', {
    words: { wrap: 'clip' },
    chars: true,
});

createTimeline({
    loop: true,
    defaults: { ease: 'inOut(3)', duration: 5000 }
})
    .add(words, {
        y: [$el => +$el.dataset.line % 2 ? '100%' : '-100%', '0%'],
    }, stagger(125))
    .add(chars, {
        y: $el => +$el.dataset.line % 2 ? '100%' : '-100%',
    }, stagger(10, { from: 'random' }))
    .init();