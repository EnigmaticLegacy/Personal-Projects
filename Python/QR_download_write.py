import pandas as pd
import requests
from PIL import Image, ImageDraw, ImageOps, ImageFont

def download_images_from_excel(excel_path, output_folder):
    # Read Excel file
    df = pd.read_excel(excel_path)

    # Iterate through rows and download images
    for index, row in df.iterrows():
        url = row['Qr']
        filename = row['Label']

        try:
            response = requests.get(url)
            if response.status_code == 200:
                # Save image to the specified output folder
                with open(f'{output_folder}/{filename}.jpg', 'wb') as f:
                    f.write(response.content)
                print(f"Downloaded: {filename}")
            else:
                print(f"Failed to download: {filename} (Status code: {response.status_code})")
        except Exception as e:
            print(f"Error downloading {filename}: {e}")

def write_image(excel_path,output_folder,output_folder2):
    df = pd.read_excel(excel_path)
    font_bold = 'arial-bold.ttf'
    font_size = 12
    
    for index, row in df.iterrows():
        filename = row['Label']
        description = row['Desc']
        try:
            # Write to image
            img = Image.open(f'{output_folder}/{filename}.jpg')
            draw = ImageDraw.Draw(img)
            font = ImageFont.truetype(font_bold,font_size)
            txt = filename
            draw.text((40, 135), txt, fill =(0, 0, 0), font=font)
            draw.text((3, 3), description, fill =(0, 0, 0), font=font)
            img2 = ImageOps.expand(img,border=1,fill='black')
            img2.save(f'{output_folder2}/{filename}.jpg')
            print(f"Writing: {filename}")
        except Exception as e:
            print(f"Error Writing {filename}: {e}")

if __name__ == "__main__":
    # Specify the path to Excel file and the output folder
    excel_path = "links.xlsx"
    output_folder = "images"
    output_folder2 = "images_converted"

    # Create output folder if it doesn't exist
    import os
    os.makedirs(output_folder, exist_ok=True)

    # Call the function to download images
    download_images_from_excel(excel_path, output_folder)
    write_image(excel_path,output_folder,output_folder2)
