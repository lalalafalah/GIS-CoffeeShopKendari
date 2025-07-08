<?php
include "config/koneksi.php";



?>

<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Web GIS - Pemetaan Coffee Shop Kota Kendari</title>
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.css"
    />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      rel="stylesheet"
    />
    <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css' rel='stylesheet'>

    <style>
      * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
      }

      body {
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: #333;
        overflow-x: hidden;
      }

      .header {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        padding: 20px 0;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        position: relative;
        z-index: 1000;
      }

      .header-content {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
      }

      .logo {
        display: flex;
        align-items: center;
        gap: 15px;
      }

      .logo i {
        font-size: 2.5rem;
        color: #8b4513;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
      }

      .logo h1 {
        font-size: 1.8rem;
        font-weight: 700;
        background: linear-gradient(45deg, #8b4513, #d2691e);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      }

      .info-panel {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border-radius: 15px;
        padding: 15px;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
      }

      .stats {
        display: flex;
        gap: 30px;
        align-items: center;
      }

      .stat-item {
        text-align: center;
      }

      .stat-number {
        font-size: 2rem;
        font-weight: bold;
        color: #8b4513;
        display: block;
      }

      .stat-label {
        font-size: 0.9rem;
        color: #666;
        margin-top: 5px;
      }

      .container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 20px;
        display: grid;
        grid-template-columns: 300px 1fr;
        gap: 20px;
        min-height: calc(100vh - 120px);
      }
      .user-location-icon {
        z-index: 9999;
      }

      .sidebar {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        padding: 25px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        height: fit-content;
        position: sticky;
        top: 20px;
      }

      .search-box {
        position: relative;
        margin-bottom: 25px;
      }

      .search-input {
        width: 100%;
        padding: 15px 50px 15px 20px;
        border: 2px solid #e0e0e0;
        border-radius: 25px;
        font-size: 16px;
        outline: none;
        transition: all 0.3s ease;
        background: rgba(255, 255, 255, 0.9);
      }

      .search-input:focus {
        border-color: #8b4513;
        box-shadow: 0 0 0 3px rgba(139, 69, 19, 0.1);
      }

      .search-icon {
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        color: #8b4513;
        font-size: 18px;
      }

      .coffee-list {
        max-height: 600px;
        overflow-y: auto;
        scrollbar-width: thin;
        scrollbar-color: #8b4513 #f0f0f0;
      }

      .coffee-list::-webkit-scrollbar {
        width: 8px;
      }

      .coffee-list::-webkit-scrollbar-track {
        background: #f0f0f0;
        border-radius: 4px;
      }

      .coffee-list::-webkit-scrollbar-thumb {
        background: #8b4513;
        border-radius: 4px;
      }

      .coffee-item {
        padding: 15px;
        margin-bottom: 10px;
        background: rgba(255, 255, 255, 0.8);
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        border: 2px solid transparent;
      }

      .coffee-item:hover {
        background: rgba(139, 69, 19, 0.1);
        border-color: #8b4513;
        transform: translateX(5px);
      }

      .coffee-item.active {
        background: rgba(139, 69, 19, 0.2);
        border-color: #8b4513;
      }

      .coffee-name {
        font-weight: 600;
        color: #333;
        margin-bottom: 5px;
        font-size: 14px;
      }

      .coffee-coords {
        font-size: 12px;
        color: #666;
        font-family: monospace;
      }

      .map-container {
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        position: relative;
      }

      #map {
        height: 700px;
        width: 100%;
      }

      .map-controls {
        position: absolute;
        top: 70px;
        right: 20px;
        z-index: 1000;
        display: flex;
        flex-direction: column;
        gap: 10px;
      }

      .control-btn {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
        border: none;
        padding: 12px;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        color: #8b4513;
        font-size: 16px;
      }

      .control-btn:hover {
        background: rgba(139, 69, 19, 0.9);
        color: white;
        transform: scale(1.05);
      }

      .popup-content {
        text-align: center;
        padding: 10px;
      }

      .popup-title {
        font-weight: bold;
        color: #8b4513;
        margin-bottom: 8px;
        font-size: 16px;
      }

      .popup-coords {
        font-size: 12px;
        color: #666;
        font-family: monospace;
      }

      .loading {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.9);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        transition: opacity 0.5s ease;
      }

      .loading.hidden {
        opacity: 0;
        pointer-events: none;
      }

      .spinner {
        width: 50px;
        height: 50px;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #8b4513;
        border-radius: 50%;
        animation: spin 1s linear infinite;
      }

      @keyframes spin {
        0% {
          transform: rotate(0deg);
        }
        100% {
          transform: rotate(360deg);
        }
      }

      .legend {
        position: absolute;
        bottom: 20px;
        left: 20px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        padding: 15px;
        border-radius: 12px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        z-index: 1000;
      }

      .legend-title {
        font-weight: bold;
        margin-bottom: 10px;
        color: #8b4513;
      }

      .legend-item {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 5px;
      }

      .legend-icon {
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #8b4513;
      }

      @media (max-width: 768px) {
        .container {
          grid-template-columns: 1fr;
          gap: 15px;
        }

        .sidebar {
          position: static;
          margin-bottom: 20px;
        }

        .header-content {
          flex-direction: column;
          gap: 15px;
          text-align: center;
        }

        .stats {
          gap: 20px;
        }
      }

      .fade-in {
        animation: fadeIn 0.8s ease-in;
      }

      @keyframes fadeIn {
        from {
          opacity: 0;
          transform: translateY(20px);
        }
        to {
          opacity: 1;
          transform: translateY(0);
        }
      }
    </style>
  </head>
  <body>
    <div class="loading" id="loading">
      <div class="spinner"></div>
    </div>

    <header class="header fade-in">
      <div class="header-content">
        <div class="logo">
          <i class="fas fa-coffee"></i>
          <div>
            <h1>Pemetaan Coffee Shop</h1>
            <p style="font-size: 0.9rem; color: #666; margin-top: 5px">
              Kota Kendari - Sulawesi Tenggara
            </p>
          </div>
        </div>
        <div class="info-panel">
          <div class="stats">
            <div class="stat-item">
              <span class="stat-number" id="totalShops">0</span>
              <div class="stat-label">Total Coffee Shop</div>
            </div>
            <div class="stat-item">
              <span class="stat-number" id="activeShops">0</span>
              <div class="stat-label">Ditampilkan</div>
            </div>
            <div class="stat-item">
              <div class="stat-label"><a class="btn btn-primary" href="admin/login.php">Admin</a></div>
            </div>
          </div>
        </div>
      </div>
    </header>

    <div class="container">
      <div class="sidebar fade-in">
        <div class="search-box">
          <input
            type="text"
            class="search-input"
            id="searchInput"
            placeholder="Cari coffee shop..."
          />
          <i class="fas fa-search search-icon"></i>
        </div>
        <div class="coffee-list" id="coffeeList">
          <!-- Coffee shops will be populated here -->
        </div>
      </div>

      <div class="map-container fade-in">
        <div id="map"></div>
        <br /><br /> <br><br><br>
        <div class="map-controls">
          <button class="control-btn" onclick="resetView()" title="Reset View">
            <i class="fas fa-home"></i>
          </button>
          <button
            class="control-btn"
            onclick="showNearbyShops()"
            title="Tampilkan Terdekat"
          >
            <i class="fas fa-location-crosshairs"></i>
          </button>

          <button
            class="control-btn"
            onclick="toggleFullscreen()"
            title="Fullscreen"
          >
            <i class="fas fa-expand"></i>
          </button>
        </div>
        <div class="legend">
          <div class="legend-title">Legenda</div>
          <div class="legend-item">
            <div class="legend-icon"></div>
            <span>Coffee Shop</span>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet/1.9.4/leaflet.js"></script>
    <script>
      // Data coffee shops dari dokumen
      const coffeeShops = [
        <?php
        $query = mysqli_query($conn, "SELECT * FROM coffee_shops");
        while ($row = mysqli_fetch_assoc($query)) {
          echo "{
            name: \"" . addslashes($row['name']) . "\",
            lat: {$row['lat']},
            lng: {$row['lng']}
          },";
        }
        ?>
      ];

      // Variabel global
      let map;
      let markers = [];
      let filteredShops = [...coffeeShops];

      // Inisialisasi peta
      function initMap() {
        // Koordinat tengah Kota Kendari
        const kendariCenter = [-3.995, 122.515];

        map = L.map("map").setView(kendariCenter, 12);

        // Tambahkan tile layer dengan multiple providers
        const osmLayer = L.tileLayer(
          "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png",
          {
            attribution: "© OpenStreetMap contributors",
          }
        );

        const satelliteLayer = L.tileLayer(
          "https://server.arcgisonline.com/ArcGIS/rest/services/World_Imagery/MapServer/tile/{z}/{y}/{x}",
          {
            attribution: "Tiles © Esri",
          }
        );

        osmLayer.addTo(map);

        // Layer control
        const baseMaps = {
          OpenStreetMap: osmLayer,
          Satellite: satelliteLayer,
        };

        L.control.layers(baseMaps).addTo(map);

        // Tambahkan scale control
        L.control.scale().addTo(map);

        // Load markers
        loadMarkers();
        updateStats();
      }
      function haversineDistance(lat1, lon1, lat2, lon2) {
        const R = 6371; // Radius bumi dalam km
        const toRad = (angle) => (angle * Math.PI) / 180;

        const dLat = toRad(lat2 - lat1);
        const dLon = toRad(lon2 - lon1);
        const a =
          Math.sin(dLat / 2) ** 2 +
          Math.cos(toRad(lat1)) *
            Math.cos(toRad(lat2)) *
            Math.sin(dLon / 2) ** 2;
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
        return R * c; // Hasil dalam kilometer
      }
      function showNearbyShops(radiusKm = 2) {
        getUserLocation((userLat, userLng) => {
          filteredShops = coffeeShops.filter((shop) => {
            const distance = haversineDistance(
              userLat,
              userLng,
              shop.lat,
              shop.lng
            );
            return distance <= radiusKm;
          });

          renderCoffeeList();
          loadMarkers();
          updateStats();

          // Zoom ke area user
          if (filteredShops.length > 0) {
            map.setView([userLat, userLng], 14);
          }

          // Tambahkan marker lokasi user
          const userMarker = L.marker([userLat, userLng], {
            icon: L.divIcon({
              className: "user-location-icon",
              html: `<div style="background:#1e90ff; width: 20px; height: 20px; border-radius:50%; border:3px solid white; box-shadow:0 0 10px #1e90ff;"></div>`,
              iconSize: [24, 24],
              iconAnchor: [12, 12],
            }),
          })
            .bindPopup("Lokasi Anda")
            .addTo(map);
        });
      }

      // Load markers ke peta
      function loadMarkers() {
        // Clear existing markers
        markers.forEach((marker) => map.removeLayer(marker));
        markers = [];

        filteredShops.forEach((shop, index) => {
          const customIcon = L.divIcon({
            className: "custom-marker",
            html: `<div style="
                        background: #8B4513;
                        width: 25px;
                        height: 25px;
                        border-radius: 50%;
                        border: 3px solid white;
                        box-shadow: 0 3px 10px rgba(0,0,0,0.3);
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        color: white;
                        font-size: 12px;
                        font-weight: bold;
                    ">☕</div>`,
            iconSize: [31, 31],
            iconAnchor: [15, 15],
          });

          const marker = L.marker([shop.lat, shop.lng], { icon: customIcon })
            .bindPopup(
              `
                        <div class="popup-content">
                            <div class="popup-title">${shop.name}</div>
                            <div class="popup-coords">
                                Lat: ${shop.lat.toFixed(6)}<br>
                                Lng: ${shop.lng.toFixed(6)}
                            </div>
                        </div>
                    `
            )
            .addTo(map);

          marker.shopIndex = index;
          markers.push(marker);

          // Event listener untuk marker
          marker.on("click", () => {
            highlightShopInList(index);
          });
        });
      }

      // Render daftar coffee shop
      function renderCoffeeList() {
        const coffeeList = document.getElementById("coffeeList");
        coffeeList.innerHTML = "";

        filteredShops.forEach((shop, index) => {
          const item = document.createElement("div");
          item.className = "coffee-item";
          item.innerHTML = `
                    <div class="coffee-name">${shop.name}</div>
                    <div class="coffee-coords">
                        ${shop.lat.toFixed(6)}, ${shop.lng.toFixed(6)}
                    </div>
                `;

          item.addEventListener("click", () => {
            focusOnShop(index);
            highlightShopInList(index);
          });

          coffeeList.appendChild(item);
        });
      }

      // Focus pada coffee shop tertentu
      function focusOnShop(index) {
        const shop = filteredShops[index];
        map.setView([shop.lat, shop.lng], 16);

        // Buka popup marker
        if (markers[index]) {
          markers[index].openPopup();
        }
      }

      // Highlight shop di list
      function highlightShopInList(index) {
        document.querySelectorAll(".coffee-item").forEach((item, i) => {
          item.classList.toggle("active", i === index);
        });
      }
      
      function getUserLocation(callback) {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(
            (position) => {
              const userLat = position.coords.latitude;
              const userLng = position.coords.longitude;
              console.log("User location found:", userLat, userLng); // DEBUG
              callback(userLat, userLng);
            },
            (error) => {
              console.error("Gagal mendapatkan lokasi:", error.message); // DEBUG
              alert(
                "Gagal mendapatkan lokasi pengguna. Aktifkan GPS & izin lokasi di browser."
              );
            }
          );
        } else {
          alert("Geolocation tidak didukung oleh browser ini.");
        }
      }

      // Search functionality
      function setupSearch() {
        const searchInput = document.getElementById("searchInput");

        searchInput.addEventListener("input", (e) => {
          const query = e.target.value.toLowerCase();

          filteredShops = coffeeShops.filter((shop) =>
            shop.name.toLowerCase().includes(query)
          );

          renderCoffeeList();
          loadMarkers();
          updateStats();

          // Auto zoom to fit filtered results
          if (filteredShops.length > 0) {
            const group = new L.featureGroup(markers);
            if (markers.length > 1) {
              map.fitBounds(group.getBounds().pad(0.05));
            } else if (markers.length === 1) {
              map.setView([filteredShops[0].lat, filteredShops[0].lng], 16);
            }
          }
        });
      }

      // Update statistik
      function updateStats() {
        document.getElementById("totalShops").textContent = coffeeShops.length;
        document.getElementById("activeShops").textContent =
          filteredShops.length;
      }

      // Reset view
      function resetView() {
        map.setView([-3.995, 122.515], 12);
        document.getElementById("searchInput").value = "";
        filteredShops = [...coffeeShops];
        renderCoffeeList();
        loadMarkers();
        updateStats();

        // Remove active highlighting
        document.querySelectorAll(".coffee-item").forEach((item) => {
          item.classList.remove("active");
        });
      }

      // Toggle fullscreen
      function toggleFullscreen() {
        const mapContainer = document.querySelector(".map-container");

        if (!document.fullscreenElement) {
          mapContainer.requestFullscreen().then(() => {
            setTimeout(() => map.invalidateSize(), 100);
          });
        } else {
          document.exitFullscreen().then(() => {
            setTimeout(() => map.invalidateSize(), 100);
          });
        }
      }

      // Inisialisasi aplikasi
      window.addEventListener("load", () => {
        setTimeout(() => {
          document.getElementById("loading").classList.add("hidden");
          initMap();
          renderCoffeeList();
          setupSearch();
        }, 1000);
      });

      // Responsive map resize
      window.addEventListener("resize", () => {
        if (map) {
          setTimeout(() => map.invalidateSize(), 100);
        }
      });

      // Keyboard shortcuts
      document.addEventListener("keydown", (e) => {
        if (e.key === "Escape") {
          resetView();
        }
        if (e.ctrlKey && e.key === "f") {
          e.preventDefault();
          document.getElementById("searchInput").focus();
        }
      });

      // Touch gestures for mobile
      let touchStartX = 0;
      let touchStartY = 0;

      document.addEventListener("touchstart", (e) => {
        touchStartX = e.touches[0].clientX;
        touchStartY = e.touches[0].clientY;
      });

      document.addEventListener("touchend", (e) => {
        const touchEndX = e.changedTouches[0].clientX;
        const touchEndY = e.changedTouches[0].clientY;
        const deltaX = touchEndX - touchStartX;
        const deltaY = touchEndY - touchStartY;

        // Swipe gestures
        if (Math.abs(deltaX) > Math.abs(deltaY) && Math.abs(deltaX) > 50) {
          if (deltaX > 0) {
            // Swipe right - show sidebar on mobile
            if (window.innerWidth <= 768) {
              document.querySelector(".sidebar").style.transform =
                "translateX(0)";
            }
          } else {
            // Swipe left - hide sidebar on mobile
            if (window.innerWidth <= 768) {
              document.querySelector(".sidebar").style.transform =
                "translateX(-100%)";
            }
          }
        }
      });

      // Analytics tracking (placeholder)
      function trackEvent(category, action, label) {
        console.log(`Analytics: ${category} - ${action} - ${label}`);
      }

      // Track search usage
      document.getElementById("searchInput").addEventListener("input", (e) => {
        if (e.target.value.length > 2) {
          trackEvent("Search", "Query", e.target.value);
        }
      });

      // Export data functionality
      function exportData() {
        const dataStr = JSON.stringify(filteredShops, null, 2);
        const dataBlob = new Blob([dataStr], { type: "application/json" });
        const url = URL.createObjectURL(dataBlob);
        const link = document.createElement("a");
        link.href = url;
        link.download = "kendari_coffee_shops.json";
        link.click();
        URL.revokeObjectURL(url);
      }

      // Add export button functionality
      document.addEventListener("DOMContentLoaded", () => {
        const exportBtn = document.createElement("button");
        exportBtn.className = "control-btn";
        exportBtn.innerHTML = '<i class="fas fa-download"></i>';
        exportBtn.title = "Export Data";
        exportBtn.onclick = exportData;

        setTimeout(() => {
          const controls = document.querySelector(".map-controls");
          if (controls) {
            controls.appendChild(exportBtn);
          }
        }, 1500);
      });
    </script>
  </body>
</html>
