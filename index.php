<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>AGH WIMIIP</title>
  <style>
    body { margin: 0; }
    canvas { display: block; }
  </style>
</head>
<body>

    <div style="padding: 2em; background-color: gray;">
        <span>Informatyka Techniczna - Three.js - Wizualizacja i grafika 3D: WebGL, WebGPU, Three.js (opcjonalnie react-three-fiber i lub PixiJS) [17.05.2023 r.]</span>
        <br>
        <b>Rafał Olech, Kacper Nosarzewski, Jakub Michalik, Arkadiusz Kuliś</b>
    </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/three.js/110/three.min.js"></script>
  <script>
    
    
    // Inicjalizacja sceny, kamery i renderera
    const scene = new THREE.Scene();
    const camera = new THREE.PerspectiveCamera(75, window.innerWidth / window.innerHeight, 0.1, 1000);
    const renderer = new THREE.WebGLRenderer();
    
    renderer.shadowMap.enabled = true; // Włącz cienie
    renderer.setSize(window.innerWidth, window.innerHeight);
    document.body.appendChild(renderer.domElement);
    
    // Dodanie podłoża
    const groundGeometry = new THREE.PlaneGeometry(10, 10);
    const groundMaterial = new THREE.MeshStandardMaterial({ color: 0x808080 });
    const ground = new THREE.Mesh(groundGeometry, groundMaterial);
    ground.rotation.x = -Math.PI / 2; // Obróć podłoże na płaszczyznę XZ
    ground.position.y = -1; // Ustaw pozycję podłoża
    ground.receiveShadow = true; // Podłoże odbija cienie
    scene.add(ground);

    // Dodanie geometrii (kostki) i materiału
    const geometry = new THREE.BoxGeometry();
    const geometry_ball = new THREE.SphereGeometry( 1,50,50 );

    const material = new THREE.MeshStandardMaterial({
      color: 0xE88500,
      metalness: 1, // Wysoka metaliczność
      roughness: 0.8 // Niska szorstkość
    });

    const cube = new THREE.Mesh(geometry_ball, material);
    cube.castShadow = true; // Kostka rzuca cienie
    cube.receiveShadow = true; // Kostka odbija cienie (samozacienianie)
    scene.add(cube);

    // Dodanie światła
    const light = new THREE.DirectionalLight(0xffffff, 1);
    light.position.set(1, 3, 4);
    light.castShadow = true; // Światło rzuca cienie
    scene.add(light);

    // Dodanie światła kierunkowego
    const directionalLight = new THREE.DirectionalLight(0xffffff, 0.5); // Kolor i intensywność światła kierunkowego
    directionalLight.position.set(5, 10, 3); // Ustawienie pozycji światła kierunkowego
    scene.add(directionalLight);

    // Dodanie światła ambient
    const ambientLight = new THREE.AmbientLight(0xffffff, 1); // Kolor i intensywność światła ambient
    scene.add(ambientLight);

    // Ustawienie pozycji kamery
    camera.position.z = 5;
    camera.position.x = 0;
    camera.position.y = 1;

    // Funkcja animacji
    function animate() {
      requestAnimationFrame(animate);

      // Animacja rotacji kostki
      cube.rotation.x += 0.01;
      cube.rotation.y += 0.01;

      // Obrót kamery wokół sceny
      camera.position.x = Math.sin(Date.now() * 0.0005) * 2; // Zmień wartość dla szybszego/zwolnienia obrotu
      camera.position.z = Math.cos(Date.now() * 0.0005) * 4; // Zmień wartość dla szybszego/zwolnienia obrotu
      camera.lookAt(scene.position);

      renderer.render(scene, camera);
    }

    // Wywołanie animacji
    animate();

  </script>
</body>
</html>
