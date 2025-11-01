// components/MusicPlay.vue
<template>
  <div >
    <h1>Music Player App</h1>
  </div>
  <div class="music-play">
    <div v-if="currentSong" class="music-info">
      <h2>{{ currentSong.name }}</h2>
      <p>{{ currentSong.artist }} - {{ currentSong.album }}</p>
      <p>{{ currentSong.lyrics }}</p>
    </div>
    <div class="controls">
      <button class="prev-button" @click="prevSong">上一首</button>
      <button v-if="!isPlaying" class="play-button" @click="playSong(currentSong.id)">播放</button>
      <button v-else class="pause-button" @click="pauseSong">暂停</button>
      <button class="next-button" @click="nextSong">下一首</button>
    </div>
  </div>
</template>
 
<script lang="ts">
import { defineComponent, computed, watch } from 'vue';
import { useMusicStore } from '../stores/musicStore';
import { useRoute, useRouter } from 'vue-router';
 
export default defineComponent({
  setup() {
    const musicStore = useMusicStore();
    const route = useRoute();
    const router = useRouter();
 
    // 初始化播放歌曲
    const songId = parseInt(route.params.id as string);
    musicStore.playSong(songId);
 
    // 监听当前歌曲 ID 变化，更新 URL
    watch(
      () => musicStore.currentSongId,
      (newId) => {
        if (newId !== null) {
          router.push({ path: `/play/${newId}` });
        }
      }
    );
 
    const currentSong = computed(() => musicStore.currentSong);
    const isPlaying = computed(() => musicStore.isPlaying);
 
    const playSong = (id: number) => {
      musicStore.playSong(id);
    };
 
    const pauseSong = () => {
      musicStore.pauseSong();
    };
 
    const nextSong = () => {
      musicStore.nextSong();
    };
 
    const prevSong = () => {
      musicStore.prevSong();
    };
 
    return {
      currentSong,
      isPlaying,
      playSong,
      pauseSong,
      nextSong,
      prevSong
    };
  }
});
</script>
 
<style scoped>
/* 音乐播放页面样式 */
.music-play {
  width: 80%;
  margin: 0 auto;
}
 
.music-info {
  margin-bottom: 20px;
}
 
.controls {
  margin-top: 20px;
}
 
.play-button {
  background-color: #007bff;
  color: white;
  border: none;
  padding: 5px 10px;
  cursor: pointer;
}
 
.pause-button {
  background-color: #dc3545;
  color: white;
  border: none;
  padding: 5px 10px;
  cursor: pointer;
}
.prev-button,
.next-button {
  background-color: #6c757d;
  color: white;
  border: none;
  padding: 5px 10px;
  cursor: pointer;
}
</style>