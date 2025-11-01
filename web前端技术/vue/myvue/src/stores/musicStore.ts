// stores/musicStore.ts
import { defineStore } from 'pinia';
 
export const useMusicStore = defineStore('music', {
  state: () => ({
    currentSongId: null as number | null,
    isPlaying: false,
    songs: [
      { id: 1, name: 'Song 1', artist: 'Artist 1', album: 'Album 1', lyrics: 'Lyrics of Song 1' },
      { id: 2, name: 'Song 2', artist: 'Artist 2', album: 'Album 2', lyrics: 'Lyrics of Song 2' },
      { id: 3, name: 'Song 3', artist: 'Artist 3', album: 'Album 3', lyrics: 'Lyrics of Song 3' }
    ]
  }),
  actions: {
    playSong(id: number) {
      this.currentSongId = id;
      this.isPlaying = true;
    },
    pauseSong() {
      this.isPlaying = false;
    },
    nextSong() {
      if (this.currentSongId !== null) {
        const currentIndex = this.songs.findIndex(song => song.id === this.currentSongId);
        const nextIndex = (currentIndex + 1) % this.songs.length;
        this.playSong(this.songs[nextIndex].id);
      }
    },
    prevSong() {
      if (this.currentSongId !== null) {
        const currentIndex = this.songs.findIndex(song => song.id === this.currentSongId);
        const prevIndex = (currentIndex - 1 + this.songs.length) % this.songs.length;
        this.playSong(this.songs[prevIndex].id);
      }
    }
  },
  getters: {
    currentSong: (state) => {
      return state.songs.find(song => song.id === state.currentSongId) || null;
    }
  }
});