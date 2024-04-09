import axios from "axios";

export const formats = [
   "font",
   "size",
   "bold",
   "italic",
   "underline",
   "strike",
   "color",
   "background",
   "script",
   "header",
   "blockquote",
   "code-block",
   "indent",
   "list",
   "direction",
   "align",
   "link",
   "image",
   "video",
   "formula",
];

export function getAudioLength(file) {
   return new Promise((resolve, reject) => {
      const audio = new Audio();
      audio.addEventListener("loadedmetadata", () => {
         const duration = audio.duration;
         resolve(duration);
      });
      audio.addEventListener("error", (error) => {
         reject(error);
      });
      audio.src = URL.createObjectURL(file);
   });
}

// Assume this function is triggered on a button click or similar action
export function fileExporter(path) {
   axios
      .get(path)
      .then((response) => {
         console.log(response);
         const url = window.URL.createObjectURL(new Blob([response.data]));
         const filename = response.headers["filename"];
         const link = document.createElement("a");
         link.href = url;
         link.setAttribute("download", filename);
         document.body.appendChild(link);
         link.click();
      })
      .catch((error) => {
         console.error("Error while downloading CSV:", error);
      });
}
