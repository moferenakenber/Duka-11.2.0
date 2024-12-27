<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3D Butterfly Animation</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/r134/three.min.js"></script>
    <style>
        body {
            margin: 0;
            overflow: hidden;
        }
        canvas {
            display: block;
        }
    </style>
</head>
<body>
    <script>
        // Scene, Camera, Renderer setup
        const scene = new THREE.Scene();
        const camera = new THREE.PerspectiveCamera(50, window.innerWidth / window.innerHeight, 0.1, 1000);
        const renderer = new THREE.WebGLRenderer({ antialias: true });
        renderer.setSize(window.innerWidth, window.innerHeight);
        document.body.appendChild(renderer.domElement);

        // Butterfly Group
        const butterfly = new THREE.Group();

        // Body
        const bodyGeometry = new THREE.CylinderGeometry(0.1, 0.1, 1, 16);
        const bodyMaterial = new THREE.MeshBasicMaterial({ color: 0x333333 });
        const body = new THREE.Mesh(bodyGeometry, bodyMaterial);
        body.rotation.z = Math.PI / 2;
        butterfly.add(body);

        // Wings
        const wingGeometry = new THREE.PlaneGeometry(1.5, 2);
        const wingMaterial = new THREE.MeshBasicMaterial({ color: 0xff7f50, side: THREE.DoubleSide });
        const leftWing = new THREE.Mesh(wingGeometry, wingMaterial);
        const rightWing = new THREE.Mesh(wingGeometry, wingMaterial);

        leftWing.position.set(0, 0.5, 0.5);
        rightWing.position.set(0, -0.5, 0.5);
        rightWing.rotation.y = Math.PI;

        butterfly.add(leftWing);
        butterfly.add(rightWing);

        scene.add(butterfly);

        // Position camera
        camera.position.z = 5;

        // Animation
        let wingFlap = 0;
        const animate = () => {
            requestAnimationFrame(animate);

            // Wing flapping effect
            const wingSpeed = 0.1;
            wingFlap += wingSpeed;
            const flapAngle = Math.sin(wingFlap) * Math.PI / 6; // +- 30 degrees
            leftWing.rotation.z = flapAngle;
            rightWing.rotation.z = -flapAngle;

            // Rotate butterfly slowly
            butterfly.rotation.y += 0.005;

            renderer.render(scene, camera);
        };

        animate();

        // Responsive resizing
        window.addEventListener('resize', () => {
            camera.aspect = window.innerWidth / window.innerHeight;
            camera.updateProjectionMatrix();
            renderer.setSize(window.innerWidth, window.innerHeight);
        });
    </script>
</body>
</html>
