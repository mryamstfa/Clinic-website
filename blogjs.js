const posts = {
  1: {
    title: "Diabetes Mellitus",
    content:
      "Description: A chronic condition where the body is unable to regulate blood sugar levels effectively due to either insufficient insulin production (Type 1) or insulin resistance (Type 2).Symptoms: Increased thirst, frequent urination, fatigue, and blurred vision.Treatment: Managed through insulin injections, oral medications, diet, and exercise."
  },
  2: {
    title: "Hypertension (High Blood Pressure)",
    content:
      "Description: A condition where the force of the blood against artery walls is too high, potentially leading to heart disease or stroke.Symptoms: Often asymptomatic but can include headaches or shortness of breath in severe cases.Treatment: Lifestyle changes (diet and exercise) and medications like ACE inhibitors or beta-blockers."
  },
  3: {
    title: "Tuberculosis (TB)",
    content:
      "Description: An infectious disease caused by the bacterium Mycobacterium tuberculosis, typically affecting the lungs but can spread to other organs.Symptoms: Persistent cough, fever, night sweats, and weight loss.Treatment: Long-term antibiotic therapy, often requiring multiple drugs for six months or more."
  },
  4: {
    title: "Alzheimer's Disease",
    content:
      "Description: A progressive neurological disorder that causes memory loss, cognitive decline, and behavioral changes, commonly seen in older adults.Symptoms: Forgetfulness, confusion, difficulty completing familiar tasks, and personality changes.Treatment: No cure, but medications and therapies can help manage symptoms and improve quality of life."
  },
  5: {
    title: "Asthma",
    content:
      "Description: A chronic respiratory condition characterized by inflammation and narrowing of the airways, leading to difficulty breathing.Symptoms: Wheezing, shortness of breath, chest tightness, and coughing, especially during exercise or at night.Treatment: Inhalers (bronchodilators and corticosteroids), avoiding triggers, and long-term control medications."
  },
  6: {
    title: "Dengue Fever",
    content:
      "Description: A viral infection transmitted by Aedes mosquitoes, causing flu-like symptoms and, in severe cases, bleeding and organ damage (dengue hemorrhagic fever).Symptoms: High fever, severe headache, joint and muscle pain, and rash.Treatment: Supportive care such as hydration and pain relievers; no specific antiviral treatment is currently available."
  }
};

function showPost(postId) {
  const modal = document.getElementById("postModal");
  const postTitle = document.getElementById("postTitle");
  const postContent = document.getElementById("postContent");

  postTitle.innerText = posts[postId].title;
  postContent.innerText = posts[postId].content;

  modal.style.display = "flex";
}

function closeModal() {
  const modal = document.getElementById("postModal");
  modal.style.display = "none";
}
