<template>
  <div class="input-group">
    <input type="hidden" name="kode" class="form-control" v-model="kode" @keyup.enter="sendMessage" />
    <input type="hidden" name="nama" class="form-control" v-model="nama" @keyup.enter="sendMessage" />
    <textarea
      id="btn-input"
      type="text"
      name="message"
      class="form-control"
      v-model="newMessage"
      @keyup.enter="sendMessage"
    ></textarea>
    &nbsp;
    <button id="show" @click="startConverting" class="btn btn-warning rounded-circle">
      <i class="pe-7s-micro"></i>
    </button>
    <button style="display:none" id="hide" @click="kuy" class="btn btn-danger rounded-circle">
      <i class="pe-7s-power"></i>
    </button>
    &nbsp;
    <button id="btn-chat" @click="sendMessage" class="btn btn-info rounded-circle">
      <i id="span" class="pe-7s-paper-plane"></i>
    </button>
  </div>
</template>

<script>
export default {
  props: ["user", "kode", "nama"],

  data() {
    return {
      newMessage: "",
    };
  },

  methods: {
    sendMessage() {
      let val = document.getElementById("btn-input").value;

      let hasil = val
        .replace(/njir/gi, "****")
        .replace(/anjing/gi, "******")
        .replace(/ajg/gi, "***")
        .replace(/anjay/gi, "*****")
        .replace(/babi/gi, "****")
        .replace(/celeng/gi, "******")
        .replace(/monyet/gi, "******")
        .replace(/beruk/gi, "*****")
        .replace(/kunyuk/gi, "******")
        .replace(/bajingan/gi, "********")
        .replace(/badjingan/gi, "*********")
        .replace(/jingan/gi, "******")
        .replace(/asu/gi, "***")
        .replace(/bangsat/gi, "*******")
        .replace(/bangset/gi, "*******")
        .replace(/bgst/gi, "****")
        .replace(/jancuk/gi, "******")
        .replace(/juancuk/gi, "*******")
        .replace(/jncuk/gi, "*****")
        .replace(/jnck/gi, "****")
        .replace(/kampret/gi, "*******")
        .replace(/kontol/gi, "******")
        .replace(/kntl/gi, "****")
        .replace(/kontl/gi, "*****")
        .replace(/kntol/gi, "*****")
        .replace(/kintil/gi, "******")
        .replace(/kontil/gi, "******")
        .replace(/memek/gi, "*****")
        .replace(/ngentod/gi, "*******")
        .replace(/ngentot/gi, "*******")
        .replace(/kentod/gi, "******")
        .replace(/kentot/gi, "******")
        .replace(/kntod/gi, "*****")
        .replace(/kntot/gi, "*****")
        .replace(/kenthu/gi, "******")
        .replace(/peler/gi, "*****")
        .replace(/peli/gi, "****")
        .replace(/ngewe/gi, "*****")
        .replace(/jembut/gi, "******")
        .replace(/jembud/gi, "******")
        .replace(/jmbt/gi, "****")
        .replace(/bego/gi, "****")
        .replace(/goblok/gi, "******")
        .replace(/goblog/gi, "******")
        .replace(/gblk/gi, "****")
        .replace(/tolol/gi, "*****")
        .replace(/idiot/gi, "*****")
        .replace(/koplok/gi, "******")
        .replace(/brengsek/gi, "********")
        .replace(/dobol/gi, "*****")
        .replace(/tengik/gi, "******")
        .replace(/fuck/gi, "****")
        .replace(/fack/gi, "****")
        .replace(/fck/gi, "***")
        .replace(/shit/gi, "****")
        .replace(/damn/gi, "****");
      this.newMessage = hasil;
      this.$emit("messagesent", {
        user: this.user,
        message: this.newMessage,
        kode: this.kode,
        nama: this.nama,
      });

      this.newMessage = "";
    },

    startConverting() {
      let r = document.getElementById("btn-input");

      if ("webkitSpeechRecognition" in window) {
        let speechRecognizer = new webkitSpeechRecognition();
        speechRecognizer.continuous = true;
        speechRecognizer.interimResults = true;
        speechRecognizer.lang = "id-ID";

        speechRecognizer.start();

        let finalTranscripts = "";

        speechRecognizer.onresult = function (event) {
          let interimTranscripts = "";
          for (let i = event.resultIndex; i < event.results.length; i++) {
            let transcript = event.results[i][0].transcript;
            transcript.replace("\n", "<br>");
            if (event.results[i].isFinal) {
              finalTranscripts += transcript;
            } else {
              interimTranscripts += transcript;
            }
          }
          r.value = finalTranscripts + " " + interimTranscripts;
        };
        speechRecognizer.onerror = function (event) {};
        document.getElementById("show").style.display = "none";
        document.getElementById("hide").style.display = "block";
      } else {
        r.value = "Gagal";
      }
    },

    kuy() {
      let r = document.getElementById("btn-input");

      if ("webkitSpeechRecognition" in window) {
        let speechRecognizer = new webkitSpeechRecognition();
        speechRecognizer.continuous = true;
        speechRecognizer.interimResults = true;
        speechRecognizer.lang = "id-ID";

        speechRecognizer.start();

        document.getElementById("show").style.display = "block";
        document.getElementById("hide").style.display = "none";
      } else {
        r.value = "Gagal";
      }
    },
  },
};
</script>
