// components/MusicList.vue
<template>
  <div >
    <h1>Music Player App</h1>
  </div>
  <div class="music-list">
    <div
      v-for="(song, index) in songs"
      :key="song.id"
      :class="['music-item', index % 2 === 0 ? 'even-row' : 'odd-row']"
      @click="goToPlay(song.id)"
    >
      <h3>{{ song.name }}</h3>
      <p>{{ song.artist }} - {{ song.album }}</p>
    </div>
  </div>
</template>
 
<script lang="ts">
import { defineComponent } from 'vue';
import { useMusicStore } from '../stores/musicStore';
import { useRouter } from 'vue-router';
 
export default defineComponent({
  setup() {
    const musicStore = useMusicStore();
    const router = useRouter();
 
    const songs = musicStore.songs;
 
    const goToPlay = (id: number) => {
      router.push(`/play/${id}`);
    };
 
    return {
      songs,
      goToPlay
    };
  }
});
</script>
 
<style scoped>
/* 音乐列表样式 */
.music-list {
  width: 80%;
  margin: 0 auto;
}
 
.music-item {
  border: 1px solid #ccc;
  padding: 10px;
  margin-bottom: 10px;
}
 
.even-row {
  background-color: #f2f2f2;
}
 
.odd-row {
  background-color: #e0e0e0;
}
 
</style>