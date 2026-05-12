<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>LuxeCurtain Hub — The Art of Draping</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300;1,400;1,600&family=Tenor+Sans&display=swap" rel="stylesheet">
<style>
*, *::before, *::after { margin:0; padding:0; box-sizing:border-box; }
:root {
    --cream:#f0ebe3; --linen:#e8e0d4; --ash:#8a7f74;
    --charcoal:#2a2520; --deep:#110e0b; --darker:#0a0806;
    --gold:#b8945a; --gold-light:#d4aa6e; --gold-dim:rgba(184,148,90,0.3);
}
html { scroll-behavior:smooth; overflow-x:hidden; }
body { background:var(--deep); color:var(--cream); font-family:'Tenor Sans',sans-serif; cursor:none; overflow-x:hidden; }

/* GRAIN */
body::after {
    content:''; position:fixed; inset:-50%; z-index:9000; pointer-events:none;
    width:200%; height:200%;
    background-image:url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)'/%3E%3C/svg%3E");
    opacity:0.04; animation:grain 0.4s steps(1) infinite;
}
@keyframes grain {
    0%,100%{transform:translate(0,0)} 25%{transform:translate(-2%,3%)}
    50%{transform:translate(2%,-2%)} 75%{transform:translate(-1%,1%)}
}

/* CURSOR */
#cur { position:fixed; top:0; left:0; z-index:8999; pointer-events:none; }
#cur-ring {
    width:44px; height:44px; border:1px solid rgba(240,235,227,0.5);
    border-radius:50%; position:absolute; transform:translate(-50%,-50%);
    transition:width .35s ease,height .35s ease,border-color .35s ease,background .35s ease;
}
#cur-dot {
    width:5px; height:5px; background:var(--cream); border-radius:50%;
    position:absolute; transform:translate(-50%,-50%);
}
body.hover #cur-ring { width:64px; height:64px; border-color:var(--gold); background:rgba(184,148,90,0.06); }

/* SCROLL PROGRESS */
#prog { position:fixed; top:0; left:0; height:1px; background:var(--gold); z-index:8000; box-shadow:0 0 10px rgba(184,148,90,.7); transition:width .08s linear; }

/* LOADER */
#load {
    position:fixed; inset:0; z-index:7999; background:var(--darker);
    display:flex; flex-direction:column; align-items:center; justify-content:center;
    transition:opacity 1.4s ease, visibility 1.4s ease;
}
#load.gone { opacity:0; visibility:hidden; }
#load-logo {
    font-family:'Cormorant Garamond',serif; font-weight:300; font-style:italic;
    font-size:clamp(2.2rem,5vw,3.8rem); letter-spacing:.15em; color:var(--cream);
    opacity:0; transform:translateY(24px); animation:up 1.2s ease .4s forwards;
}
#load-tag {
    font-size:.6rem; letter-spacing:.5em; color:var(--gold); text-transform:uppercase;
    margin-top:.8rem; opacity:0; animation:up .9s ease .9s forwards;
}
#load-bar-wrap {
    width:140px; height:1px; background:rgba(255,255,255,.08);
    margin-top:2.8rem; overflow:hidden;
}
#load-bar { width:0; height:100%; background:var(--gold); animation:bar 2.2s ease 1s forwards; }
@keyframes bar { to{width:100%;} }
@keyframes up { to{opacity:1;transform:translateY(0);} }

/* NAV */
#nlogo {
    position:fixed; top:1.9rem; left:2.8rem; z-index:600;
    font-family:'Cormorant Garamond',serif; font-weight:300; font-style:italic;
    font-size:1.05rem; letter-spacing:.12em; color:var(--cream);
    opacity:0; transform:translateY(-8px);
    transition:opacity 1s ease 3.8s, transform 1s ease 3.8s;
}
body.ready #nlogo { opacity:1; transform:translateY(0); }

#burger {
    position:fixed; top:1.7rem; right:2.8rem; z-index:600;
    cursor:none; padding:.6rem; display:flex; flex-direction:column; gap:6px;
}
#burger span {
    display:block; height:1px; background:var(--cream);
    transition:transform .5s ease,opacity .5s ease,width .5s ease;
    transform-origin:left center;
}
#burger span:nth-child(1) { width:28px; }
#burger span:nth-child(2) { width:20px; }
#burger span:nth-child(3) { width:28px; }
#burger.x span:nth-child(1) { transform:rotate(38deg); width:32px; }
#burger.x span:nth-child(2) { opacity:0; }
#burger.x span:nth-child(3) { transform:rotate(-38deg); width:32px; }

#nav {
    position:fixed; inset:0; z-index:550;
    background:rgba(10,8,6,.97); backdrop-filter:blur(12px);
    display:flex; align-items:center; justify-content:center;
    opacity:0; visibility:hidden; transition:opacity .6s ease,visibility .6s ease;
}
#nav.on { opacity:1; visibility:visible; }
#navlist { display:flex; flex-direction:column; gap:1.8rem; align-items:center; }
.nl {
    font-family:'Cormorant Garamond',serif; font-size:clamp(2.8rem,6vw,5rem);
    font-weight:300; color:var(--cream); text-decoration:none; letter-spacing:.06em;
    cursor:none; opacity:0; transform:translateY(28px);
    transition:color .4s,opacity .55s ease,transform .55s ease;
}
#nav.on .nl { opacity:1; transform:translateY(0); }
#nav.on .nl:nth-child(1){transition-delay:.1s}
#nav.on .nl:nth-child(2){transition-delay:.2s}
#nav.on .nl:nth-child(3){transition-delay:.3s}
#nav.on .nl:nth-child(4){transition-delay:.4s}
#nav.on .nl:nth-child(5){transition-delay:.5s}
.nl:hover { color:var(--gold); }
.nl sup { font-family:'Tenor Sans',sans-serif; font-size:.45rem; letter-spacing:.25em; color:var(--ash); vertical-align:super; margin-left:.4rem; }

/* REVEALS */
.rev { opacity:0; transform:translateY(48px); transition:opacity 1.1s ease,transform 1.1s ease; }
.rev.show { opacity:1; transform:translateY(0); }
.rev-l { opacity:0; transform:translateX(-40px); transition:opacity 1.1s ease,transform 1.1s ease; }
.rev-l.show { opacity:1; transform:translateX(0); }
.rev-r { opacity:0; transform:translateX(40px); transition:opacity 1.1s ease,transform 1.1s ease; }
.rev-r.show { opacity:1; transform:translateX(0); }

/* HERO */
#hero {
    height:100vh; min-height:640px; position:relative; overflow:hidden;
    display:flex; align-items:flex-end; padding:0 8vw 11vh;
}
#hero-img {
    position:absolute; inset:0;
    background:url('<?php echo e($heroImageUrl ?? 'https://i.pinimg.com/736x/8f/ec/24/8fec2448ee910fb49370ffb4b1b3379e.jpg'); ?>') center/cover no-repeat;
    will-change:transform;
}
#hero-img::after {
    content:''; position:absolute; inset:0;
    background:linear-gradient(120deg,rgba(10,8,5,.9) 0%,rgba(10,8,5,.5) 50%,rgba(10,8,5,.78) 100%);
}
#hero-content { position:relative; z-index:2; max-width:680px; }
.eyebrow {
    font-size:.58rem; letter-spacing:.55em; color:var(--gold);
    text-transform:uppercase; margin-bottom:1.8rem;
    opacity:0; transform:translateX(-16px);
    transition:opacity 1.2s ease 4s,transform 1.2s ease 4s;
}
body.ready .eyebrow { opacity:1; transform:translateX(0); }
#hero h1 {
    font-family:'Cormorant Garamond',serif; font-weight:300; line-height:1.04;
    font-size:clamp(3.2rem,9vw,7.5rem); color:var(--cream); letter-spacing:-.01em;
    opacity:0; transform:translateY(36px);
    transition:opacity 1.5s ease 4.2s,transform 1.5s ease 4.2s;
}
body.ready #hero h1 { opacity:1; transform:translateY(0); }
#hero h1 em { font-style:italic; color:var(--gold-light); }
#hero p {
    margin-top:1.8rem; font-size:clamp(.8rem,1.4vw,.95rem);
    color:var(--ash); line-height:1.85; max-width:380px;
    opacity:0; transform:translateY(20px);
    transition:opacity 1.2s ease 4.7s,transform 1.2s ease 4.7s;
}
body.ready #hero p { opacity:1; transform:translateY(0); }
#hero-btns {
    margin-top:2.8rem; display:flex; gap:1.2rem; flex-wrap:wrap;
    opacity:0; transform:translateY(20px);
    transition:opacity 1.2s ease 5s,transform 1.2s ease 5s;
}
body.ready #hero-btns { opacity:1; transform:translateY(0); }

.btn {
    display:inline-block; cursor:none; position:relative; overflow:hidden;
    text-decoration:none; font-size:.62rem; letter-spacing:.35em; text-transform:uppercase;
}
.btn-outline {
    padding:.85rem 2.4rem; border:1px solid rgba(184,148,90,.55); color:var(--gold-light);
    transition:color .5s,border-color .5s;
}
.btn-outline::before {
    content:''; position:absolute; inset:0; background:var(--gold);
    transform:scaleX(0); transform-origin:left; transition:transform .5s cubic-bezier(.76,0,.24,1);
}
.btn-outline:hover { color:var(--deep); border-color:var(--gold); }
.btn-outline:hover::before { transform:scaleX(1); }
.btn-outline span { position:relative; z-index:1; }
.btn-text { color:var(--ash); padding:.85rem 0; border-bottom:1px solid rgba(138,127,116,.3); transition:color .3s,border-color .3s; }
.btn-text:hover { color:var(--cream); border-color:var(--cream); }

#scroll-hint {
    position:absolute; bottom:3rem; right:8vw; z-index:2;
    display:flex; flex-direction:column; align-items:center; gap:.8rem;
    opacity:0; transition:opacity 1s ease 5.5s;
}
body.ready #scroll-hint { opacity:.4; }
#scroll-hint span { font-size:.52rem; letter-spacing:.4em; color:var(--ash); writing-mode:vertical-rl; text-transform:uppercase; }
#scroll-line { width:1px; height:55px; background:linear-gradient(180deg,var(--ash),transparent); animation:pulse 2s ease-in-out infinite; }
@keyframes pulse { 0%,100%{opacity:.4;transform:scaleY(1)} 50%{opacity:.15;transform:scaleY(.6)} }

/* STATEMENT BAND */
#statement {
    padding:14vh 12vw; text-align:center; position:relative;
}
#statement::before {
    content:''; position:absolute; top:0; left:50%; transform:translateX(-50%);
    width:1px; height:70px; background:linear-gradient(180deg,transparent,var(--gold));
}
#statement h2 {
    font-family:'Cormorant Garamond',serif; font-weight:300;
    font-size:clamp(1.9rem,4.5vw,3.5rem); line-height:1.35; color:var(--cream); letter-spacing:.02em;
}
#statement h2 em { font-style:italic; color:var(--gold-light); }
#statement p { margin-top:1.8rem; font-size:.72rem; letter-spacing:.18em; color:var(--ash); }

/* MARQUEE */
.mq-wrap { overflow:hidden; border-top:1px solid rgba(255,255,255,.05); border-bottom:1px solid rgba(255,255,255,.05); padding:4.5vh 0; }
.mq { display:flex; gap:3.5rem; white-space:nowrap; animation:mq 28s linear infinite; }
.mq span { font-family:'Cormorant Garamond',serif; font-size:clamp(1.4rem,2.8vw,2rem); font-weight:300; font-style:italic; color:var(--ash); flex-shrink:0; }
.mq .sep { color:var(--gold); font-style:normal; font-size:.7rem; display:flex; align-items:center; }
@keyframes mq { from{transform:translateX(0)} to{transform:translateX(-50%)} }

/* COLLECTION */
#collection { padding:10vh 5vw 12vh; }
.sec-label { font-size:.58rem; letter-spacing:.5em; color:var(--gold); text-transform:uppercase; margin-bottom:3.5vh; }
.sec-head {
    display:flex; justify-content:space-between; align-items:baseline;
    margin-bottom:5vh;
}
.sec-head h3 { font-family:'Cormorant Garamond',serif; font-size:clamp(1.4rem,3vw,2.4rem); font-weight:300; font-style:italic; color:var(--cream); }
.sec-head a { font-size:.58rem; letter-spacing:.35em; color:var(--ash); text-decoration:none; cursor:none; text-transform:uppercase; transition:color .3s; }
.sec-head a:hover { color:var(--gold); }

.grid4 {
    display:grid;
    grid-template-columns:1.5fr 1fr 1fr;
    grid-template-rows:auto auto;
    gap:3px;
}
.card { position:relative; overflow:hidden; cursor:none; background:#111; }
.card:first-child { grid-row:span 2; }
.card-img {
    width:100%; padding-bottom:75%; position:relative; overflow:hidden;
}
.card:first-child .card-img { padding-bottom:120%; }
.card-img img {
    position:absolute; inset:0; width:100%; height:100%; object-fit:cover;
    transition:transform 1s cubic-bezier(.25,.46,.45,.94), filter .6s ease;
    filter:brightness(.75) saturate(.85);
}
.card:hover .card-img img { transform:scale(1.07); filter:brightness(.92) saturate(1); }
.card-over {
    position:absolute; inset:0;
    background:linear-gradient(0deg,rgba(8,6,4,.92) 0%,rgba(8,6,4,.1) 50%,transparent 100%);
    display:flex; flex-direction:column; justify-content:flex-end;
    padding:1.8rem 1.5rem;
    opacity:0; transform:translateY(6px);
    transition:opacity .5s,transform .5s;
}
.card:hover .card-over { opacity:1; transform:translateY(0); }
.card-name { font-family:'Cormorant Garamond',serif; font-size:1.4rem; font-weight:300; color:var(--cream); letter-spacing:.04em; }
.card-tag { margin-top:.3rem; font-size:.55rem; letter-spacing:.3em; color:var(--gold); text-transform:uppercase; }
.card-price { margin-top:.6rem; font-size:.7rem; color:var(--ash); letter-spacing:.15em; }

/* IMMERSIVE PHOTO STRIP */
#strip {
    display:grid; grid-template-columns:repeat(5,1fr); height:42vh; gap:3px;
}
.strip-img { overflow:hidden; position:relative; }
.strip-img img {
    width:100%; height:100%; object-fit:cover;
    filter:brightness(.6) saturate(.7);
    transition:transform .9s ease,filter .6s ease;
}
.strip-img:hover img { transform:scale(1.08); filter:brightness(.85) saturate(1); }
.strip-img span {
    position:absolute; bottom:1rem; left:50%; transform:translateX(-50%);
    font-size:.52rem; letter-spacing:.35em; color:rgba(240,235,227,.7);
    text-transform:uppercase; white-space:nowrap;
    opacity:0; transition:opacity .4s;
}
.strip-img:hover span { opacity:1; }

/* PHILOSOPHY */
#philosophy { padding:14vh 7vw; display:grid; grid-template-columns:1fr 1.1fr; gap:8vw; align-items:center; }
.phil-title { font-family:'Cormorant Garamond',serif; font-size:clamp(2rem,4.5vw,3.8rem); font-weight:300; line-height:1.2; color:var(--cream); }
.phil-title em { font-style:italic; color:var(--gold-light); }
.gold-line { width:40px; height:1px; background:var(--gold); margin:2.5rem 0; }
.phil-text p { font-size:clamp(.8rem,1.2vw,.9rem); color:var(--ash); line-height:2; margin-bottom:1.4rem; }
.stats { display:grid; grid-template-columns:1fr 1fr; gap:2rem; margin-top:2.5rem; border-top:1px solid rgba(255,255,255,.06); padding-top:2.5rem; }
.stat-n { font-family:'Cormorant Garamond',serif; font-size:2.8rem; font-weight:300; color:var(--cream); line-height:1; }
.stat-l { font-size:.58rem; letter-spacing:.3em; color:var(--ash); text-transform:uppercase; margin-top:.35rem; }

.phil-img { position:relative; }
.phil-img img { width:100%; height:580px; object-fit:cover; filter:brightness(.78) saturate(.9); display:block; }
.phil-img::before {
    content:''; position:absolute; inset:0;
    background:linear-gradient(135deg,rgba(184,148,90,.1) 0%,transparent 50%);
    z-index:1; pointer-events:none;
}
.phil-caption {
    position:absolute; bottom:0; left:0; right:0; z-index:2;
    padding:3rem 2rem 1.5rem;
    background:linear-gradient(0deg,rgba(8,6,4,.88),transparent);
    font-size:.6rem; letter-spacing:.3em; color:var(--ash); text-transform:uppercase;
}

/* FEATURED CINEMATIC */
#featured {
    position:relative; min-height:80vh;
    display:flex; align-items:center;
    overflow:hidden;
}
#feat-img {
    position:absolute; inset:0;
    background:url('<?php echo e($featuredImageUrl ?? 'https://i.pinimg.com/736x/58/9f/92/589f92fba7423b01456d998ff1718eb5.jpg'); ?>') center/cover no-repeat;
}
#feat-img::after {
    content:''; position:absolute; inset:0;
    background:linear-gradient(90deg,rgba(8,6,4,.93) 0%,rgba(8,6,4,.6) 55%,rgba(8,6,4,.2) 100%);
}
#feat-content { position:relative; z-index:2; padding:10vh 8vw; max-width:560px; }
#feat-content .eyebrow { opacity:1 !important; transform:none !important; transition:none !important; }
#feat-content h2 {
    font-family:'Cormorant Garamond',serif; font-size:clamp(2.4rem,5.5vw,5rem);
    font-weight:300; line-height:1.08; color:var(--cream);
}
#feat-content h2 em { font-style:italic; color:var(--gold-light); }
#feat-content p { margin-top:1.5rem; font-size:.88rem; color:var(--ash); line-height:1.9; }

/* LOOKBOOK */
#lookbook { padding:10vh 5vw; }
.lb-grid {
    display:grid;
    grid-template-columns:repeat(3,1fr);
    grid-template-rows:auto auto;
    gap:3px;
}
.lb-cell { position:relative; overflow:hidden; cursor:none; }
.lb-cell img {
    width:100%; display:block; object-fit:cover;
    filter:brightness(.68) saturate(.78);
    transition:transform 1s ease,filter .6s ease;
}
.lb-cell:hover img { transform:scale(1.05); filter:brightness(.9) saturate(1.1); }
.lb-cell:nth-child(1) { grid-column:span 2; }
.lb-cell:nth-child(1) img { height:480px; }
.lb-cell:nth-child(2) img { height:480px; }
.lb-cell:nth-child(3) img { height:320px; }
.lb-cell:nth-child(4) img { height:320px; }
.lb-cell:nth-child(5) img { height:320px; }
.lb-label {
    position:absolute; bottom:0; left:0; right:0;
    background:linear-gradient(0deg,rgba(8,6,4,.9),transparent);
    padding:2.5rem 1.5rem 1.2rem;
    opacity:0; transition:opacity .5s;
}
.lb-cell:hover .lb-label { opacity:1; }
.lb-label p { font-family:'Cormorant Garamond',serif; font-size:1.2rem; font-weight:300; color:var(--cream); }
.lb-label span { font-size:.55rem; letter-spacing:.3em; color:var(--gold); text-transform:uppercase; }

/* PROCESS */
#process { padding:12vh 7vw; border-top:1px solid rgba(255,255,255,.05); }
#process .sec-label { text-align:center; }
.proc-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:0; margin-top:7vh; }
.proc-step {
    padding:0 2.5rem 0 0; position:relative;
    border-right:1px solid rgba(255,255,255,.06);
}
.proc-step:last-child { border-right:none; padding-right:0; }
.proc-step + .proc-step { padding-left:2.5rem; }
.p-num { font-family:'Cormorant Garamond',serif; font-size:4rem; font-weight:300; color:rgba(184,148,90,.15); line-height:1; margin-bottom:1.5rem; }
.p-icon { font-size:1.4rem; margin-bottom:1rem; }
.p-head { font-size:.68rem; letter-spacing:.28em; color:var(--cream); text-transform:uppercase; margin-bottom:.9rem; }
.p-body { font-size:.8rem; color:var(--ash); line-height:1.85; }

/* FULL BLEED */
#fullbleed {
    height:55vh; position:relative; overflow:hidden;
}
#fullbleed img { width:100%; height:100%; object-fit:cover; filter:brightness(.5) saturate(.7); display:block; }
#fullbleed::after {
    content:''; position:absolute; inset:0;
    background:linear-gradient(0deg,rgba(8,6,4,.7) 0%,transparent 50%,rgba(8,6,4,.4) 100%);
}
#fullbleed-text {
    position:absolute; inset:0; z-index:2;
    display:flex; align-items:center; justify-content:center; flex-direction:column; text-align:center;
}
#fullbleed-text h2 {
    font-family:'Cormorant Garamond',serif; font-size:clamp(2rem,5vw,4rem);
    font-weight:300; font-style:italic; color:var(--cream); letter-spacing:.05em;
}
#fullbleed-text p { margin-top:1rem; font-size:.7rem; letter-spacing:.35em; color:var(--gold); text-transform:uppercase; }

/* TESTIMONIALS */
#testimonials { padding:14vh 7vw; display:grid; grid-template-columns:1fr 1fr 1fr; gap:3px; }
.t-card {
    padding:3.5rem 2.5rem; background:rgba(255,255,255,.025);
    border:1px solid rgba(255,255,255,.05);
    transition:background .4s,border-color .4s;
}
.t-card:hover { background:rgba(184,148,90,.04); border-color:rgba(184,148,90,.2); }
.t-stars { color:var(--gold); font-size:.7rem; letter-spacing:.2em; margin-bottom:1.8rem; }
.t-quote {
    font-family:'Cormorant Garamond',serif; font-size:1.2rem; font-weight:300;
    font-style:italic; color:var(--cream); line-height:1.65; margin-bottom:2rem;
}
.t-cite { font-size:.58rem; letter-spacing:.35em; color:var(--ash); text-transform:uppercase; }

/* CONTACT */
#contact { padding:12vh 7vw; display:grid; grid-template-columns:1fr 1.2fr; gap:8vw; align-items:start; border-top:1px solid rgba(255,255,255,.05); }
.contact-h { font-family:'Cormorant Garamond',serif; font-size:clamp(2rem,4vw,3.5rem); font-weight:300; line-height:1.2; color:var(--cream); }
.contact-h em { font-style:italic; color:var(--gold-light); }
.contact-body { margin-top:1.5rem; font-size:.85rem; color:var(--ash); line-height:1.95; }
.contact-info { margin-top:3rem; display:flex; flex-direction:column; gap:1.4rem; }
.ci-row span:first-child { display:block; font-size:.55rem; letter-spacing:.42em; color:var(--gold); text-transform:uppercase; margin-bottom:.4rem; }
.ci-row span:last-child { font-size:.88rem; color:var(--cream); }

.form { display:flex; flex-direction:column; gap:1.3rem; }
.fg label { display:block; font-size:.55rem; letter-spacing:.42em; color:var(--ash); text-transform:uppercase; margin-bottom:.6rem; }
.fg input,.fg textarea,.fg select {
    width:100%; background:transparent;
    border:none; border-bottom:1px solid rgba(255,255,255,.1);
    padding:.7rem 0; color:var(--cream);
    font-family:'Tenor Sans',sans-serif; font-size:.88rem;
    outline:none; cursor:none; transition:border-color .3s;
}
.fg select option { background:var(--deep); }
.fg input:focus,.fg textarea:focus,.fg select:focus { border-bottom-color:var(--gold); }
.fg textarea { resize:none; height:75px; }
.fg input::placeholder,.fg textarea::placeholder { color:var(--ash); opacity:.45; }

/* FOOTER */
footer {
    border-top:1px solid rgba(255,255,255,.05);
    padding:4vh 7vw;
    display:grid; grid-template-columns:1fr auto 1fr;
    align-items:center; gap:2rem;
}
.f-logo { font-family:'Cormorant Garamond',serif; font-weight:300; font-style:italic; font-size:1.1rem; letter-spacing:.12em; color:var(--cream); }
.f-copy { font-size:.58rem; letter-spacing:.2em; color:var(--ash); text-align:center; }
.f-links { display:flex; gap:2rem; justify-content:flex-end; }
.f-links a { font-size:.58rem; letter-spacing:.25em; color:var(--ash); text-decoration:none; cursor:none; text-transform:uppercase; transition:color .3s; }
.f-links a:hover { color:var(--gold); }

@media(max-width:1024px){
    #philosophy{grid-template-columns:1fr;gap:5vh}
    .proc-grid{grid-template-columns:1fr 1fr;gap:3rem}
    .proc-step{border-right:none;padding:0 0 2rem}
    .proc-step+.proc-step{padding-left:0;border-top:1px solid rgba(255,255,255,.05);padding-top:2rem}
    #testimonials{grid-template-columns:1fr}
    #contact{grid-template-columns:1fr;gap:5vh}
    .lb-grid{grid-template-columns:1fr 1fr}
    .lb-cell:nth-child(1){grid-column:span 2}
    footer{grid-template-columns:1fr 1fr;gap:1.5rem}
    .f-copy{grid-column:span 2;order:3;text-align:left}
}
@media(max-width:700px){
    .grid4{grid-template-columns:1fr 1fr}.card:first-child{grid-row:span 1}
    #strip{grid-template-columns:1fr 1fr;height:auto}
    .strip-img img{height:200px}
    .lb-grid{grid-template-columns:1fr}
    .lb-cell:nth-child(1){grid-column:span 1}
    body{cursor:auto}#cur{display:none}
    footer{grid-template-columns:1fr}
    .f-copy,.f-links{grid-column:span 1}
}
</style>
</head>
<body>

<div id="prog"></div>
<div id="cur"><div id="cur-ring"></div><div id="cur-dot"></div></div>

<!-- LOADER -->
<div id="load">
    <div id="load-logo">LuxeCurtain Hub</div>
    <div id="load-tag">The Art of Draping · Kampala</div>
    <div id="load-bar-wrap"><div id="load-bar"></div></div>
</div>

<!-- NAV -->
<div id="nlogo">LCH</div>
<div id="burger" onclick="toggleNav()"><span></span><span></span><span></span></div>
<div id="nav">
    <nav id="navlist">
        <a class="nl" href="#collection" onclick="closeNav()">Collection<sup>01</sup></a>
        <a class="nl" href="#philosophy" onclick="closeNav()">Philosophy<sup>02</sup></a>
        <a class="nl" href="#lookbook" onclick="closeNav()">Lookbook<sup>03</sup></a>
        <a class="nl" href="#process" onclick="closeNav()">Process<sup>04</sup></a>
        <a class="nl" href="#contact" onclick="closeNav()">Contact<sup>05</sup></a>
    </nav>
</div>

<!-- ═══════ HERO ═══════ -->
<section id="hero" style="opacity:1;transform:none">
    <div id="hero-img"></div>
    <div id="hero-content">
        <div class="eyebrow">Curtain Studio — Est. 2020</div>
        <h1>Where <em>light</em><br>learns<br>to rest</h1>
        <p>Bespoke curtains and window dressings, handcrafted for spaces that deserve more than the ordinary.</p>
        <div id="hero-btns">
            <a href="#collection" class="btn btn-outline"><span>Explore Collection</span></a>
            <a href="#contact" class="btn btn-text">Book Consultation →</a>
        </div>
    </div>
    <div id="scroll-hint"><div id="scroll-line"></div><span>Scroll</span></div>
</section>

<!-- ═══════ STATEMENT ═══════ -->
<section id="statement" class="rev">
    <h2>Every fold tells a story.<br><em>Every room deserves a masterpiece.</em></h2>
    <p>Handcrafted in Uganda &nbsp;·&nbsp; Delivered nationwide &nbsp;·&nbsp; Installed with precision</p>
</section>

<!-- MARQUEE -->
<div class="mq-wrap">
    <div class="mq">
        <span>Sheer Linen</span><span class="sep">✦</span><span>Velvet Drapes</span><span class="sep">✦</span>
        <span>Blackout Panels</span><span class="sep">✦</span><span>Custom Tailoring</span><span class="sep">✦</span>
        <span>Roman Blinds</span><span class="sep">✦</span><span>Silk Sheers</span><span class="sep">✦</span>
        <span>Eyelet Curtains</span><span class="sep">✦</span><span>Motorized Systems</span><span class="sep">✦</span>
        <span>Sheer Linen</span><span class="sep">✦</span><span>Velvet Drapes</span><span class="sep">✦</span>
        <span>Blackout Panels</span><span class="sep">✦</span><span>Custom Tailoring</span><span class="sep">✦</span>
        <span>Roman Blinds</span><span class="sep">✦</span><span>Silk Sheers</span><span class="sep">✦</span>
        <span>Eyelet Curtains</span><span class="sep">✦</span><span>Motorized Systems</span><span class="sep">✦</span>
    </div>
</div>

<!-- ═══════ COLLECTION ═══════ -->
<section id="collection" class="rev">
    <div style="padding:0 2vw">
        <div class="sec-label">Current Collection</div>
        <div class="sec-head">
            <h3>Signature Pieces</h3>
            <a href="#contact">View All &rarr;</a>
        </div>
    </div>
    <div class="grid4">
        <?php $__currentLoopData = $featuredProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card">
            <div class="card-img">
                <img src="<?php echo e($product['image_url'] ?? 'https://i.pinimg.com/736x/87/79/54/877954c4a6f8f6549608182d802d1d2b.jpg'); ?>" alt="<?php echo e($product['name']); ?>" loading="lazy">
            </div>
            <div class="card-over">
                <div class="card-name"><?php echo e($product['name']); ?></div>
                <div class="card-tag"><?php echo e($product['category']); ?></div>
                <div class="card-price">$<?php echo e($product['price']); ?></div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>

<!-- ═══════ PHOTO STRIP ═══════ -->
<div id="strip">
    <?php $__currentLoopData = $stripImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="strip-img">
        <img src="<?php echo e($image['image_url']); ?>" alt="<?php echo e($image['alt_text']); ?>" loading="lazy">
        <span><?php echo e($image['caption'] ?? $image['title']); ?></span>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>

<!-- ═══════ PHILOSOPHY ═══════ -->
<section id="philosophy">
    <div class="rev-l">
        <div class="sec-label">Our Philosophy</div>
        <h2 class="phil-title">Cloth is the <em>architecture</em><br>of atmosphere</h2>
        <div class="gold-line"></div>
        <div class="phil-text">
            <p>We believe a curtain is never just a curtain. It is the threshold between inside and outside, between private and public, between the ordinary day and the spaces where you truly live.</p>
            <p>Each piece is measured, cut, and finished by hand at our Kampala atelier — made to your exact specifications, your exact light, your exact life.</p>
        </div>
        <div class="stats">
            <div><div class="stat-n">500+</div><div class="stat-l">Homes Transformed</div></div>
            <div><div class="stat-n">12+</div><div class="stat-l">Fabric Collections</div></div>
            <div><div class="stat-n">48hr</div><div class="stat-l">Consultation Response</div></div>
            <div><div class="stat-n">100%</div><div class="stat-l">Custom Made</div></div>
        </div>
    </div>
    <div class="phil-img rev-r">
        <img src="https://i.pinimg.com/736x/58/9f/92/589f92fba7423b01456d998ff1718eb5.jpg" alt="Curtain interior detail" loading="lazy">
        <div class="phil-caption">Handcrafted &nbsp;·&nbsp; Kampala Atelier &nbsp;·&nbsp; Since 2020</div>
    </div>
</section>

<!-- ═══════ FEATURED CINEMATIC ═══════ -->
<section id="featured">
    <div id="feat-img"></div>
    <div id="feat-content" class="rev">
        <div class="eyebrow">Signature Series</div>
        <h2>The <em>Golden Hour</em><br>Collection</h2>
        <p>Warm linen-silk blends that catch afternoon light like liquid amber. Designed for living rooms that deserve a moment of daily magic.</p>
        <div style="margin-top:2.5rem">
            <a href="#contact" class="btn btn-outline"><span>Request Consultation</span></a>
        </div>
    </div>
</section>

<!-- ═══════ LOOKBOOK ═══════ -->
<section id="lookbook" class="rev">
    <div style="margin-bottom:5vh">
        <div class="sec-label">Lookbook</div>
        <div class="sec-head" style="margin-bottom:0">
            <h3>Rooms We've Dressed</h3>
            <a href="#contact">See More &rarr;</a>
        </div>
    </div>
    <div class="lb-grid">
        <?php $__currentLoopData = $lookbookImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="lb-cell">
            <img src="<?php echo e($image['image_url']); ?>" alt="<?php echo e($image['alt_text']); ?>" loading="lazy">
            <div class="lb-label"><p><?php echo e($image['title']); ?></p><span><?php echo e($image['caption'] ?? 'LuxeCurtain Hub'); ?></span></div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>

<!-- ═══════ JOURNAL ═══════ -->
<section class="rev" style="padding:10vh 7vw; border-top:1px solid rgba(255,255,255,.05);">
    <div class="sec-label">Journal</div>
    <div class="sec-head">
        <h3>Articles & Success Stories</h3>
        <a href="#contact">Publish More &rarr;</a>
    </div>
    <div class="card-grid">
        <?php $__currentLoopData = $blogPosts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <article class="card" style="padding:0;background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.05);">
                <img src="<?php echo e($post['image_url'] ?? 'https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=900&q=80'); ?>" alt="<?php echo e($post['title']); ?>" loading="lazy" style="width:100%;height:240px;object-fit:cover;display:block;">
                <div style="padding:1.25rem;">
                    <h3><?php echo e($post['title']); ?></h3>
                    <p style="color:var(--ash);line-height:1.8;"><?php echo e($post['excerpt']); ?></p>
                </div>
            </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>

<!-- ═══════ PROCESS ═══════ -->
<section id="process" class="rev">
    <div class="sec-label" style="text-align:center">How We Work</div>
    <div class="proc-grid" style="margin-top:7vh">
        <div class="proc-step">
            <div class="p-num">01</div>
            <div class="p-icon">📐</div>
            <div class="p-head">Consultation</div>
            <p class="p-body">We visit your space, understand your light, your life, and your aesthetic vision — completely free.</p>
        </div>
        <div class="proc-step">
            <div class="p-num">02</div>
            <div class="p-icon">🎨</div>
            <div class="p-head">Fabric Selection</div>
            <p class="p-body">Choose from 200+ curated fabrics with swatches brought to your home, or we source to your exact vision.</p>
        </div>
        <div class="proc-step">
            <div class="p-num">03</div>
            <div class="p-icon">✂️</div>
            <div class="p-head">Handcrafting</div>
            <p class="p-body">Every curtain cut and sewn by hand at our Kampala atelier with meticulous care and precision.</p>
        </div>
        <div class="proc-step">
            <div class="p-num">04</div>
            <div class="p-icon">🏠</div>
            <div class="p-head">Installation</div>
            <p class="p-body">Our team installs everything with perfect hang, drape, and finish — guaranteed to your satisfaction.</p>
        </div>
    </div>
</section>

<!-- ═══════ FULL BLEED ═══════ -->
<div id="fullbleed">
    <img src="https://i.pinimg.com/736x/87/79/54/877954c4a6f8f6549608182d802d1d2b.jpg" alt="Luxury curtain interior" loading="lazy">
    <div id="fullbleed-text" class="rev">
        <h2>"The room became itself."</h2>
        <p>Every window we dress tells a different story</p>
    </div>
</div>

<!-- ═══════ TESTIMONIALS ═══════ -->
<section id="testimonials" class="rev">
    <?php $__currentLoopData = $successStories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $story): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div class="t-card">
        <div class="t-stars">★★★★★</div>
        <div class="t-quote">"<?php echo e($story['quote']); ?>"</div>
        <div class="t-cite"><?php echo e($story['client_name']); ?> &nbsp;·&nbsp; <?php echo e($story['location']); ?></div>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</section>

<!-- ═══════ CONTACT ═══════ -->
<section id="contact" class="rev">
    <div>
        <h2 class="contact-h">Begin your<br><em>transformation</em></h2>
        <p class="contact-body">Book a complimentary home consultation. We come to you, study your space, and propose a bespoke solution that fits both your vision and budget.</p>
        <?php if(session('success')): ?>
            <div style="margin-top:1.5rem;padding:1rem 1.2rem;border:1px solid rgba(184,148,90,.35);color:var(--gold-light);background:rgba(184,148,90,.08);font-size:.78rem;line-height:1.8;">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>
        <div class="contact-info">
            <div class="ci-row"><span>Location</span><span>Uganda</span></div>
            <div class="ci-row"><span>Email</span><span>arrindamark@gmail.com</span></div>
            <div class="ci-row"><span>WhatsApp</span><span>+256 772 513 055</span></div>
            <div class="ci-row"><span>Hours</span><span>Mon – Sat, 8am – 6pm</span></div>
        </div>
    </div>
    <form class="form" action="<?php echo e(route('consultation.store')); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <div class="fg">
            <label for="full_name">Full Name</label>
            <input id="full_name" name="full_name" type="text" placeholder="Your name" value="<?php echo e(old('full_name')); ?>">
            <?php $__errorArgs = ['full_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div style="margin-top:.45rem;color:#cf8d7d;font-size:.65rem;letter-spacing:.12em;text-transform:uppercase;"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="fg">
            <label for="phone">Phone / WhatsApp</label>
            <input id="phone" name="phone" type="text" placeholder="+256 ..." value="<?php echo e(old('phone')); ?>">
            <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div style="margin-top:.45rem;color:#cf8d7d;font-size:.65rem;letter-spacing:.12em;text-transform:uppercase;"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="fg">
            <label for="email">Email</label>
            <input id="email" name="email" type="email" placeholder="your@email.com" value="<?php echo e(old('email')); ?>">
            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div style="margin-top:.45rem;color:#cf8d7d;font-size:.65rem;letter-spacing:.12em;text-transform:uppercase;"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="fg">
            <label>Space Type</label>
            <select id="space_type" name="space_type">
                <option value="">Select your space...</option>
                <option <?php echo e(old('space_type') === 'Living Room' ? 'selected' : ''); ?>>Living Room</option>
                <option <?php echo e(old('space_type') === 'Bedroom' ? 'selected' : ''); ?>>Bedroom</option>
                <option <?php echo e(old('space_type') === 'Dining Room' ? 'selected' : ''); ?>>Dining Room</option>
                <option <?php echo e(old('space_type') === 'Home Office' ? 'selected' : ''); ?>>Home Office</option>
                <option <?php echo e(old('space_type') === 'Commercial / Office' ? 'selected' : ''); ?>>Commercial / Office</option>
                <option <?php echo e(old('space_type') === 'Multiple Rooms' ? 'selected' : ''); ?>>Multiple Rooms</option>
                <option <?php echo e(old('space_type') === 'Full Home' ? 'selected' : ''); ?>>Full Home</option>
            </select>
            <?php $__errorArgs = ['space_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div style="margin-top:.45rem;color:#cf8d7d;font-size:.65rem;letter-spacing:.12em;text-transform:uppercase;"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <div class="fg">
            <label for="vision">Your Vision</label>
            <textarea id="vision" name="vision" placeholder="Tell us about your space, preferred fabrics, colours, or any inspiration..."><?php echo e(old('vision')); ?></textarea>
            <?php $__errorArgs = ['vision'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <div style="margin-top:.45rem;color:#cf8d7d;font-size:.65rem;letter-spacing:.12em;text-transform:uppercase;"><?php echo e($message); ?></div> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        <button type="submit" class="btn btn-outline" style="text-align:center;background:transparent;border:none;padding:0;"><span>Send Request</span></button>
    </form>
</section>

<!-- FOOTER -->
<footer>
    <div class="f-logo">LuxeCurtain Hub</div>
    <div class="f-copy">© 2026 LuxeCurtain Hub &nbsp;·&nbsp; Uganda</div>
    <div class="f-links">
        <a href="#">Instagram</a>
        <a href="#">WhatsApp</a>
        <a href="#">Facebook</a>
        <a href="#contact">Contact</a>
    </div>
</footer>

<script>
// CURSOR
const cring=document.getElementById('cur-ring');
const cdot=document.getElementById('cur-dot');
let mx=0,my=0,rx=0,ry=0;
document.addEventListener('mousemove',e=>{ mx=e.clientX; my=e.clientY; cdot.style.left=mx+'px'; cdot.style.top=my+'px'; });
(function loop(){ rx+=(mx-rx)*.1; ry+=(my-ry)*.1; cring.style.left=rx+'px'; cring.style.top=ry+'px'; requestAnimationFrame(loop); })();
document.querySelectorAll('a,button,.card,.lb-cell,.strip-img,.t-card,input,textarea,select,#burger').forEach(el=>{
    el.addEventListener('mouseenter',()=>document.body.classList.add('hover'));
    el.addEventListener('mouseleave',()=>document.body.classList.remove('hover'));
});

// LOADER
window.addEventListener('load',()=>{
    setTimeout(()=>{
        document.getElementById('load').classList.add('gone');
        document.body.classList.add('ready');
    },3000);
});

// NAV
let navOn=false;
function toggleNav(){
    navOn=!navOn;
    document.getElementById('burger').classList.toggle('x',navOn);
    document.getElementById('nav').classList.toggle('on',navOn);
}
function closeNav(){
    navOn=false;
    document.getElementById('burger').classList.remove('x');
    document.getElementById('nav').classList.remove('on');
}

// SCROLL REVEALS
const obs=new IntersectionObserver(es=>{
    es.forEach(e=>{ if(e.isIntersecting){ e.target.classList.add('show'); obs.unobserve(e.target); } });
},{threshold:.07});
document.querySelectorAll('.rev,.rev-l,.rev-r').forEach(el=>obs.observe(el));

// PROGRESS
const pbar=document.getElementById('prog');
window.addEventListener('scroll',()=>{
    const p=window.scrollY/(document.body.scrollHeight-window.innerHeight);
    pbar.style.width=(p*100)+'%';
});

// PARALLAX HERO
window.addEventListener('scroll',()=>{
    const y=window.scrollY;
    const hi=document.getElementById('hero-img');
    if(hi&&y<window.innerHeight) hi.style.transform='translateY('+(y*.3)+'px)';
});
</script>
</body>
</html>
<?php /**PATH C:\Users\MARK ARINDA\Desktop\LuxeCurtainHub\resources\views/home.blade.php ENDPATH**/ ?>