import gsap from "gsap";
import ScrollTrigger from "gsap/ScrollTrigger";

gsap.registerPlugin(ScrollTrigger);

gsap.from(".news-header", {
    opacity: 0,
    y: 40,
    duration: 1,
    ease: "power2.out",
    scrollTrigger: {
        trigger: ".news-header",
        start: "top 85%",
        toggleActions: "play none none reverse",
    },
});

gsap.from(".news-card", {
    opacity: 0,
    y: 60,
    duration: 0.9,
    ease: "power2.out",
    stagger: 0.15,
    scrollTrigger: {
        trigger: "#viewBerita",
        start: "top 85%",
        toggleActions: "play none none reverse",
    },
});
