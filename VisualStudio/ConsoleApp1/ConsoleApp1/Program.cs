using Microsoft.ProjectOxford.Face;
using Microsoft.ProjectOxford.Face.Contract;
using System;
using System.Collections.Generic;
using System.IO;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace ConsoleApp1
{
    class Program
    {
        FaceServiceClient faceServiceClient = new FaceServiceClient("f72f0fc759c14ad182c7581832e235a3", "https://westcentralus.api.cognitive.microsoft.com/face/v1.0"); 
        public async void CreatePersonGroup (string personGroupID, string personGroupName)
        {
            try
            {
                PersonGroup p = await faceServiceClient.GetPersonGroupAsync(personGroupID);
                if (p == null)
                {
                    await faceServiceClient.CreatePersonGroupAsync(personGroupID, personGroupName);
                }
               
            }
            catch (Exception ex)
            {
                Console.WriteLine("Error creando el grupo de personas \n" + ex.Message);
            }
        }

        public async void addPersonToGroup(string personGroupID, string name, string pathImage)
        {
            try
            {
                await faceServiceClient.GetPersonGroupAsync(personGroupID);
                CreatePersonResult person = await faceServiceClient.CreatePersonAsync(personGroupID, name);
                DetectFaceAndRegister(personGroupID, person, pathImage);
            }
            catch (Exception ex)
            {
                Console.WriteLine("Error agregando persona al grupo \n" + ex.Message);
            }
        }

        private async void DetectFaceAndRegister(string personGroupID, CreatePersonResult person, string pathImage)
        {
            foreach(var imgPath in Directory.GetFiles(pathImage, "*.jpg"))
            {
                using (Stream s = File.OpenRead(imgPath))
                {
                    await faceServiceClient.AddPersonFaceAsync(personGroupID, person.PersonId, s);
                    Console.WriteLine("imagen agregada: " + imgPath);
                    Console.Out.Flush();
                    await Task.Delay(5000);
                   // System.Threading.Thread.Sleep(5000);
                }
            }
        }
        
        public async void TrainingAI(string personGroupId)
        {
            await faceServiceClient.TrainPersonGroupAsync(personGroupId);
            TrainingStatus trainingStatus = null;
            while (true)
            {
                trainingStatus = await faceServiceClient.GetPersonGroupTrainingStatusAsync(personGroupId);
                if (trainingStatus.Status != Status.Running)
                {
                    break;
                    await Task.Delay(1000);
                }
                Console.WriteLine("Entrenamiento IA finalizado");
            }
        }

        public async void RecognitionFace(string personGroupId)
        {
            string img = @"D:\Facultad\TFI\desarrollo\VisualStudio\Img\Futbolistas\Messi.jpg";
            using (Stream s = File.OpenRead(img))
            {
                var faces = await faceServiceClient.DetectAsync(s);
                var faceIds = faces.Select(face => face.FaceId).ToArray();

                try
                {
                    var results = await faceServiceClient.IdentifyAsync(personGroupId, faceIds);
                    foreach(var identifyResult in results)
                    {
                        Console.WriteLine($"Resultado: { identifyResult.FaceId }");
                        if (identifyResult.Candidates.Length == 0)
                        {
                            Console.WriteLine("No se encontraron resultados");
                        }
                        else
                        {
                            var candidateId = identifyResult.Candidates[0].PersonId;
                            var person = await faceServiceClient.GetPersonAsync(personGroupId, candidateId);
                            Console.WriteLine($"Identificado como: {person.Name}");
                        }
                    }
                }
                catch (Exception ex)
                {
                    Console.WriteLine("Error reconociendo persona \n" + ex.Message);
                }
            }
        }
        
        static void Main(string[] args)
        {
            //  new Program().CreatePersonGroup("fut", "Futbolistas");

            //   new Program().addPersonToGroup("fut", "Bati", @"D:\Facultad\TFI\desarrollo\VisualStudio\Img\Futbolistas\Batistuta\");
            //   new Program().addPersonToGroup("fut", "Messi", @"D:\Facultad\TFI\desarrollo\VisualStudio\Img\Futbolistas\Messi\");
            //   new Program().addPersonToGroup("fut", "Maradona", @"D:\Facultad\TFI\desarrollo\VisualStudio\Img\Futbolistas\Maradona\");

            //   new Program().TrainingAI("fut");

            //new Program().RecognitionFace("fut");

            // new Program().CreatePersonGroup("pac", "Pacientes");

            //     new Program().addPersonToGroup("pac", "1", @"D:\Facultad\TFI\desarrollo\VisualStudio\Img\Pacientes\Anibal\");
            //     new Program().addPersonToGroup("pac", "2", @"D:\Facultad\TFI\desarrollo\VisualStudio\Img\Pacientes\Ale\");
           //      new Program().addPersonToGroup("pac", "3", @"D:\Facultad\TFI\desarrollo\VisualStudio\Img\Pacientes\Emi\");
           //      new Program().addPersonToGroup("pac", "4", @"D:\Facultad\TFI\desarrollo\VisualStudio\Img\Pacientes\Vic\");
           //      new Program().addPersonToGroup("pac", "5", @"D:\Facultad\TFI\desarrollo\VisualStudio\Img\Pacientes\Juan\");
           //      new Program().addPersonToGroup("pac", "6", @"D:\Facultad\TFI\desarrollo\VisualStudio\Img\Pacientes\JuanF\");
            //     new Program().addPersonToGroup("pac", "7", @"D:\Facultad\TFI\desarrollo\VisualStudio\Img\Pacientes\Gustavo\");
           //      new Program().addPersonToGroup("pac", "8", @"D:\Facultad\TFI\desarrollo\VisualStudio\Img\Pacientes\Nico\");
           //      new Program().addPersonToGroup("pac", "9", @"D:\Facultad\TFI\desarrollo\VisualStudio\Img\Pacientes\Bati\");
           //      new Program().addPersonToGroup("pac", "10", @"D:\Facultad\TFI\desarrollo\VisualStudio\Img\Pacientes\Messi\");

            new Program().TrainingAI("pac");
               
           // new Program().RecognitionFace("pac");
            Console.ReadLine();
            //api de cognitive services - Face
            //https://westcentralus.dev.cognitive.microsoft.com/docs/services/563879b61984550e40cbbe8d/operations/563879b61984550f30395244/console
            //https://westcentralus.dev.cognitive.microsoft.com/docs/services/563879b61984550e40cbbe8d/operations/563879b61984550f30395248
            //https://westcentralus.dev.cognitive.microsoft.com/docs/services/563879b61984550e40cbbe8d/operations/563879b61984550f30395241/console

        }
    }
}
